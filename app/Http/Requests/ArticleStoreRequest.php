<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:256',
            'body' => 'required|string|max:1024',
            'img' => 'required|image|mimes:jpeg,png,jpg,,svg',
            'source' => 'string|max:1024',
            'link' => 'string|max:1024',
            'date' => 'required|date',
            'user_ids'   => 'array|nullable',
            'user_ids.*' => 'exists:users,id', //
        ];
    }
}
