<?php

namespace App\Http\Requests;

use App\Rules\WorkerLocationValidation;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the worker is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * 
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'arrival_time' => 'required|date_format:Y-m-d H:i:s',
            'latitude'     => ['required', 'decimal:2,6', new WorkerLocationValidation()],
            'longitude'    => 'required|decimal:2,6|min:0'
        ];
    }
}
