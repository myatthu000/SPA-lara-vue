<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name'=>'required|string|min:3',
            'price'=>'required|numeric|min:10'
        ];
    }

    public function messages()
    {
//        return parent::messages(); // TODO: Change the autogenerated stub
        return [
            'name.required'=>"အမည်ထည့်ရန်လိုအပ်သည်။",
            'name.string'=>"အမည်ထည့်ရန်လိုအပ်သည်။",
            'price.required'=>"ဈေးနှုန်းထည့်ရန်လိုအပ်သည်။"
        ];
    }
}
