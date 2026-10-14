<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'genre_id' => ['sometimes', 'required', 'integer', 'exists:genres,id'],
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'author' => ['sometimes', 'required', 'string', 'max:255'],
            'pages' => ['nullable', 'integer', 'min:1'],
            'status' => ['sometimes', 'in:to_read,reading,finished'],
            'rating' => ['nullable', 'integer', 'min:1', 'max:5'],
        ];
    }
}
