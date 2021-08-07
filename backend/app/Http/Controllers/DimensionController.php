<?php

namespace App\Http\Controllers;

use App\Models\Dimension;

class DimensionController extends Controller
{

    public function model() {
        return Dimension::class;
    }

    public function index() {
        $dimensions = $this->model()::orderBy('name')->get();

        return response()->json($dimensions->toArray());
    }

}
