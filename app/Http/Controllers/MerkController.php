<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MerkController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Merk::select('*');;
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

        return view('master_data.merk');
    }


    public function store(Request $request)
    {
        Merk::create([
            'nama' => $request->nama
        ]);

        return response()->json(['success' => 'Data Berhasil Disimpan !']);
    }

    public function getMerk($id)
    {
        $data = Merk::where('id', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $merk = Merk::where('id', $request->id)->first();
        $merk->update([
            'nama' => $request->nama,
        ]);
        return response()->json(['success' => 'Data Berhasil Diupdate !']);
    }

    public function destroy($id)
    {
        $merk = Merk::where('id', $id);
        $merk->delete();

        return response()->json(['success' => 'Data Berhasil Dihapus !']);
    }
}
