<?php

namespace App\Http\Requests\Topics;

use Illuminate\Foundation\Http\FormRequest;

class StoteTopic extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'title' => 'required|unique:topics',
            'body' => 'required'
        ];
    }
}