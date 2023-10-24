<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Jobs\ShowCorrectAnswersJob;
use App\Models\Answer;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeUnit\FileUnit;

class TestController extends Controller
{
    public function test_get(): JsonResponse
    {
        $questions = Question::with('choices');

        ShowCorrectAnswersJob::dispatchAfterResponse()->delay(now()->addMinutes(1));

        return $this->successResponse(data: QuestionResource::make($questions) , message: "you have one minute! then the page will reload with the correct answers");
    }

   public function test_result(Request $request): JsonResponse
   {

       $request->user()->answer()->delete();

       $total_points = 0;
       $answers = [];
       foreach ($request->get('questions') as $question_id => $choice_id){
           $question = Question::find($question_id);
           $correct = Choice::where('question_id' , $question_id)
                        ->where('choice_id' , $choice_id)
                        ->where('correct' , 1)->count() > 0;

            Answer::create([
               'question_id' => $question_id,
               'choice_id' => $choice_id,
               'correct' => $correct
            ]);

            if ($correct){
                $total_points += $question->score;
            }
            $user = $request->user();
            $answers = $user->answers()->get();
       }


       $test_result = [];
       $answers = $request->user()->answers;

       $test_result= [
           'answers' => $answers,
           'total_points' => $total_points
       ];

       return $this->successResponse(data: $test_result);

   }

   public function correct_answers(): JsonResponse
   {
       $correct_answers = Question::with('choices')->where('correct' , 1)->get();

       return $this->successResponse(data: $correct_answers);
   }
}
