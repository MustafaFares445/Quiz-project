<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed $question_title
 * @property mixed $question_type
 * @property mixed $score
 */
class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'question_title' => ['required' , 'string'],
            'question_type' => ['required' , Rule::in(['true/false' , 'multiple-choice' , 'choose-one'])],
            'score' => ['required' , 'int'],
        ];
    }
}
