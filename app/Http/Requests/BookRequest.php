<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title'            => 'required|min:8',
            'category_id'      => 'required',
            'writer'           => 'required|min:10',
            'publication_year' => 'required',
            'publisher'        => 'required|min:8',
            'description'      => 'required|min:30',
            'price'            => 'required|numeric|min:1',
            'weight'           => 'required|numeric|min:0.1',
            'stock'            => 'required|numeric|min:10',
            'image'            => 'sometimes|required|mimes:jpg,png,jpeg|max:1000',
        ];
    }
}
