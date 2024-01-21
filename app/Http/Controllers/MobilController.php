<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use App\Models\Mobil;
use App\Models\ModelMobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MobilController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('mobils')
                ->select('mobils.id', 'mobils.no_plat', 'mobils.tarif', 'merks.nama as merk', 'model_mobils.nama as model')
                ->join('merks', 'merks.id', '=', 'mobils.merk')
                ->join('model_mobils', 'model_mobils.id', '=', 'mobils.model');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="flex gap-2">';
                    $btn .= '<a href="javascript:void(0)" class="edit btn btn-info btn-sm" data-id="' . $row->id . '">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Delete</a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->filter(function ($query) use ($request) {
                    if (!empty($request->get('search'))) {
                        $search = $request->get('search');
                        $query->orWhere('merks.nama', 'LIKE', "%$search%")
                            ->orWhere('model_mobils.nama', 'LIKE', "%$search%")
                            ->orWhere('mobils.no_plat', 'LIKE', "%$search%");
                    }
                })
                ->make(true);
        }




        $models = ModelMobil::all();
        $merks = Merk::all();
        return view('management_mobil.info_data_mobil', compact('models', 'merks'));
    }

    public function store(Request $request)
    {
        Mobil::create([
            'merk' => $request->merk,
            'model' => $request->model,
            'no_plat' => $request->no_plat,
            'tarif' => $request->tarif
        ]);
        // dd($request->all());
        return response()->json(['success' => 'Data Berhasil Disimpan !']);
    }

    public function getMobil($id)
    {
        $data = Mobil::where('id', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $mobil = Mobil::where('id', $request->id)->first();
        $mobil->update([
            'merk' => $request->merk,
            'model' => $request->model,
            'no_plat' => $request->no_plat,
            'tarif' => $request->tarif
        ]);
        return response()->json(['success' => 'Data Berhasil Diupdate !']);
    }

    public function destroy($id)
    {
        $mobil = Mobil::where('id', $id);
        $mobil->delete();

        return response()->json(['success' => 'Data Berhasil Dihapus !']);
    }
}
