<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Choice;
use App\Models\Question;
use App\Src\Shared\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use \Illuminate\Support\Facades\Validator;
class QuestionController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions =  Question::paginate(15);

        $this->successResponse($questions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
       $question = Question::create([
           'question_title' => $request->question_title,
           'question_type' => $request->question_type,
           'score' => $request->score
       ]);

        foreach ($request->choices as $choice){

            Choice::create([
                'question_id' => $question->id,
                'content' => $choice->content,
                'correct' => $choice->correct
            ]);
        }

        $this->successResponse(message: 'question and choices has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question): JsonResponse
    {
        return $this->successResponse($question->with('choices')->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $question = Question::update([
            'question_title' => $request->question_title,
            'question_type' => $request->question_type,
            'score' => $request->score
        ]);

        foreach ($request->choices as $choice){
            Choice::update([
                'question_id' => $question->id,
                'content' => $choice->content,
                'correct' => $choice->correct
            ]);
        }

        $this->successResponse(message: 'question and choices has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();

        $this->successResponse(message: 'question and choices has been deleted successfully');
    }
}
