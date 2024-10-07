<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateTipsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'total_tips' => 'required|numeric|min:0',
            'employee_tips' => 'required|array',
            'employee_tips.*' => 'required|numeric|min:0',
        ];
    }
}