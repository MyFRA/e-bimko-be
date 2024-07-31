<?php

namespace App\Http\Requests\Api\Mobile\Login;

use App\Repositories\MobileUserRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
            'device_id' => ['required', function ($attribute, $value, $fail) {
                try {
                    $mobileUserRepository = new MobileUserRepository();

                    $mobileUser = $mobileUserRepository->findByNipNisn(request()->nip_nisn);

                    if ($mobileUser->device_id != null) {
                        if ($mobileUser->device_id != $value) {
                            $fail(' NIP / NISN telah tertaut di perangkat lain');
                        }
                    } else {
                        $isDeviceIdExistsInDb = $mobileUserRepository->checkIsDeviceIdExistsInDB($value);

                        if ($isDeviceIdExistsInDb) {
                            $fail(' Device telah digunakan di NIP / NISN lain');
                        }
                    }
                } catch (\Throwable $th) {
                    $fail('NIP / NISN telah tertaut di perangkat lain');
                }
            }]
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
