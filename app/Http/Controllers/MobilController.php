<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use DataTables;

class MobilController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Mobil::select('*');
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
                            $w->orWhere('merk', 'LIKE', "%$search%")
                                ->orWhere('model', 'LIKE', "%$search%");
                        });
                    }
                })
                ->make(true);
        }

        return view('management_mobil.info_data_mobil');
    }
}
