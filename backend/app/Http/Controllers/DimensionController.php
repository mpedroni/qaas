<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Dimension;
use App\Models\Question;

class DimensionController extends Controller
{

    public function model() {
        return Dimension::class;
    }

    public function index() {
        $dimensions = $this->model()::orderBy('name')->get();

        return response()->json($dimensions->toArray());
    }

    public function find($id) {
        $dimensions = $this->model()::find($id);

        return response()->json($dimensions);
    }

    public function store(Request $request) {
        $name = trim($request->get('name'));
        
        if(!$name) 
            return response()->json(['message' => 'O nome da dimensão não pode ser vazio'], 400);
        

        $dimension = $this->model()::create(['name' => $name]);

        return $dimension;
    }

    public function update(Request $request, $id) {
        $dimension = $this->model()::find($id);

        $dimension->fill($request->all())->save();

        $dimensions = $this->model()::all();

        return response()->json($dimensions);
    }

    public function delete($id) {
        $question = Question::where('dimension_id', $id)->whereNull('deleted_at')->first();

        if($question) 
            return response()->json(['message' => 'Não foi possível excluir essa dimensão pois existem perguntas vinculadas a ela'], 400);

        $deletedDimensions = $this->model()::where('id', $id)->delete();

        if(!$deletedDimensions)
            return response()->json(['message' => 'Ops! Não foi possível deletar essa dimensão.'], 400);
    }
}
