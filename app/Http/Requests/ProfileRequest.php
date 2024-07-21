<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "first_name" => ['required','max:30'],
            "last_name" => ['required','max:30'],
            "tel" => ['required','regex:/^[0-9]{10}$/'],
            "address" => ['required'],
            "province" => ['required','numeric'],
            "district" => ['required','numeric'],
            "ward" => ['required','numeric'],
        ];
    }
}
