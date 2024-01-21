<?php

namespace App\Http\Controllers;

use App\Models\ModelMobil;
use Illuminate\Http\Request;
use DataTables;

class ModelMobilController extends Controller
{
    public function index(Request $request)
    {
        // $merk = Merk::paginate(5);
        // return view('master_data.merk', compact('merk'));
        if ($request->ajax()) {
            $data = ModelMobil::select('*');
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
                ->filter(function ($instance) use ($request) {

                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('nama', 'LIKE', "%$search%");
                        });
                    }
                })
                ->make(true);
        }

        return view('master_data.model');
    }

    public function store(Request $request)
    {
        ModelMobil::create([
            'nama' => $request->nama
        ]);

        return response()->json(['success' => 'Data Berhasil Disimpan !']);
    }

    public function getModel($id)
    {
        $data = ModelMobil::where('id', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $model = ModelMobil::where('id', $request->id)->first();
        $model->update([
            'nama' => $request->nama,
        ]);
        return response()->json(['success' => 'Data Berhasil Diupdate !']);
    }

    public function destroy($id)
    {
        $model = ModelMobil::where('id', $id);
        $model->delete();

        return response()->json(['success' => 'Data Berhasil Dihapus !']);
    }
}
