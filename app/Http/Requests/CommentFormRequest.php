<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'post_id' => ['required', 'integer', Rule::exists('posts', 'id')],
            'content' => ['required', 'string', 'min:1', 'max:65535'],
        ];
    }
}
