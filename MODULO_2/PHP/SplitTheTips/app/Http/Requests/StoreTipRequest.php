<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ajusta esto según tus necesidades de autorización
    }

    public function rules()
    {
        return [
            'total_tips' => 'required|numeric|min:0',
            'date' => 'required|date',
            'employee_tips' => 'required|array',
            'employee_tips.*' => 'required|numeric|min:0',
        ];
    }
}