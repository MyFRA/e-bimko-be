<?php

namespace App\Http\Requests\Api\Mobile\Login;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class GetCurrentUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nip_nisn' => 'required|exists:mobile_users,nip_nisn',
            'device_id' => 'required|exists:mobile_users,device_id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'code'  => 422,
            'msg'   => "Error Validations",
            'error' => $validator->errors()->first(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
