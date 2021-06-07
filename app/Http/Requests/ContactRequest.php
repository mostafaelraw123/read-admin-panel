<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'=>'nullable|string|min:2',
            'email' => 'nullable|string|email|max:190',
            'phone' => 'nullable|numeric|digits_between:1,20',
            'message' => 'nullable|string|max:2000',
            'subject' => 'nullable|string|max:2000',
        ];
    }
}
