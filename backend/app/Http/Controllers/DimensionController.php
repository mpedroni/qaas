<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function store(Request $request) {
        $name = trim($request->get('name'));
        
        if(!$name) {
            return response()->json(['message' => 'O nome da dimensão não pode ser vazio'], 400);
        }

        $dimension = $this->model()::create(['name' => $name]);

        return $dimension;
    }

}
