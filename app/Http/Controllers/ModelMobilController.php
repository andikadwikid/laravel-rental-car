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
            $data = ModelMobil::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">View</a>';
                    // $btn = $btn . '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                    // $btn = $btn . '<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->filter(function ($instance) use ($request) {

                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('kode', 'LIKE', "%$search%")
                                ->orWhere('nama', 'LIKE', "%$search%");
                        });
                    }
                })
                ->make(true);
        }

        return view('master_data.model');
    }

    public function getData()
    {
        $model = ModelMobil::all();
        return response()->json($model, 200);
    }
}
