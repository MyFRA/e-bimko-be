<?php

namespace App\Http\Requests\Panel\Article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'thumbnail' => 'nullable|mimes:jpg,jpeg,png,webp',
            'content' => 'required|string',
            'article_category_id' => 'required|exists:article_categories,id',
        ];
    }
}
