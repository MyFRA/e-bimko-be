<?php

namespace App\Http\Requests\Panel\Student;

use App\Repositories\StudentsRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $studentRepository = new StudentsRepository();
        $student = $studentRepository->findById(request()->route('id'));

        return [
            'name' => 'required|string',
            'nisn' => 'required|string|unique:mobile_users,nip_nisn,' . $student->mobileUser->id,
            'gender' => 'required|in:Male,Female',
            'profile_pict' => 'nullable|mimes:jpg,jpeg,png,webp',
            'dob' => 'required|date',
            'academic_year_start' => 'required|date_format:Y',
            'academic_year_end' => [
                'required',
                'date_format:Y',
                'gt:academic_year_start',
                function ($attribute, $value, $fail) {
                    try {
                        if (request()->academic_year_start + 1 != $value) {
                            $fail($attribute . ' should be +1 academic year start');
                        }
                    } catch (\Throwable $th) {
                        $fail($attribute . ' should be +1 academic year start');
                    }
                }
            ],
        ];
    }
}
