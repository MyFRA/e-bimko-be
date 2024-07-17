<?php

namespace App\Http\Requests\Panel\Teacher;

use App\Repositories\TeachersRepository;
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
        $teacherRepository = new TeachersRepository();
        $teacher = $teacherRepository->findById(request()->route('id'));

        return [
            'name' => 'required|string',
            'nip' => 'required|string|unique:mobile_users,nip_nisn,' . $teacher->mobileUser->id,
            'gender' => 'required|in:Male,Female',
            'profile_pict' => 'nullable|mimes:jpg,jpeg,png,webp',
        ];
    }
}
