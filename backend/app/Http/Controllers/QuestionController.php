<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Question;

class QuestionController extends Controller
{

    public function model() {
        return Question::class;
    }

    public function index() {
        $questions = $this->model()::all();

        return response()->json($questions);
    }

    public function find($id) {
        $questions = $this->model()::find($id);

        return response()->json($questions);
    }

    public function store(Request $request) {
        $text = $request->text;
        $dimension_id = $request->dimension['id'];

        $question = $this->model()::create(compact('text', 'dimension_id'));

        return response()->json($question);
    }

    public function update(Request $request, $id) {
        $question = $this->model()::find($id);

        $params = [ 
            'text' => $request->text ?: $question->text,
            'dimension_id' => $request->dimension['id'] ?: $question->dimension_id,
            'active' => isset($request->active) ? $request->active : $question->active
        ];

        $question->fill($params)->save();

        $questions = $this->model()::all();

        return response()->json($questions);
    }

    public function delete($id) {
        $deletedQuestions = $this->model()::where('id', $id)->delete();

        if(!$deletedQuestions)
            return response()->json(['message' => 'Ops! Não foi possível deletar essa pergunta.'], 400);
    }
}
