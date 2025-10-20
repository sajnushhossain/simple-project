<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // We're handling authorization via middleware, so we can return true here.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|mimes:jpeg,png,bmp,gif,svg,webp,avif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}