<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;
use DataTables;

class MerkController extends Controller
{
    public function index(Request $request)
    {
        // $merk = Merk::paginate(5);
        // return view('master_data.merk', compact('merk'));
        if ($request->ajax()) {
            $data = Merk::select('*');;
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

        return view('master_data.merk');
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
        ]);

        Merk::create($request->all());

        return response()->json(['success' => 'Post saved successfully.']);
    }
}
