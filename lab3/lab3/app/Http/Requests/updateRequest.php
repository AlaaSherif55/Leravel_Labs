<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
            'title' => 'unique:posts|max:30|min:3',
            'body' => 'max:100|min:10',
            'image'=>'image|mimes:png,jpg,jpeg,svg',
            'author'=>'exists:users,id',
        ];
    }

    public function messages(): array{
        return [
            'title.unique' => 'Posts title must be unique',
            'title.max' => 'Posts title must not exceed 20 character',
            'title.min' => 'Posts title must be at least 3 character',
            'body.max:' => 'Posts body must not exceed 100 character',
            'body.min:' => 'Posts body must be at least 10 character',
            'image.image' => 'Posts image is must be image',
            'image.mimes' => 'Posts image must be one of these formats png,jpg,jpeg,svg',
            'author.exists' => 'Posts author does not exist',
        ];
    }
}
