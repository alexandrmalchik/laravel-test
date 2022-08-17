<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'string',
            'cost' => 'required|numeric',
            'published' => 'required|boolean',
            'categories' => 'required|array|between:2,10'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'categories.between' => 'The array of categories should be from 2 to 10 categories',
            'cost.numeric' => 'A cost field must contain a number with a dot',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($response = response()->json(
            [
                'success' => false,
                'message' => $validator->errors()->messages(),
                'code' => 400,
            ])
        );
    }
}
