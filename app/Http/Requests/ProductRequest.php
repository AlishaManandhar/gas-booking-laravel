<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = $this->product ? "nullable" : "required";
        return [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:1000',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048|'.$id,
            'status' => 'nullable|in:active,inactive',
        ];
    }
}
