<?php

namespace Modules\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'price'=>'required',
            'stock_quantity'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'name.required' =>'you have to enter product name',
            'price.required' =>'you have to enter product price',
            'stock_quantity.required' =>'you have to enter product stock quantity',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'status' => 'error',
            'data' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
