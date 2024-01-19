<?php

namespace App\Http\Controllers;

use App\Models\ModelMobil;
use Illuminate\Http\Request;

class ModelMobilController extends Controller
{
    public function index()
    {
        return view('master_data.model');
    }

    public function getData()
    {
        $model = ModelMobil::all();
        return response()->json($model, 200);
    }
}
