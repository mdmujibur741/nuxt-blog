<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        // return [
        //     'title'=> 'required|min:5|max:200',
        //     // 'subtitle'=> 'required|min:5|max:200',
        //     // 'description'=> 'required|min:10',
        //     'category_id' => 'required',
        // ];

        return [
            'title' => 'required',
            'subtitle' => 'required',
            'category_id' => 'required'
        ];
    }
}
