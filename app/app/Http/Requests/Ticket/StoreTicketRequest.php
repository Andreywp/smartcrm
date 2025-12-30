<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Ticket;
use Carbon\Carbon;

class StoreTicketRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'string',
                'regex:/^\+[1-9]\d{1,14}$/',
            ],
            'email' => ['nullable', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],

            'files' => ['nullable', 'array'],
            'files.*' => ['file', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Phone number must have E.164 format.',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $email = $this->input('email');
            $phone = $this->input('phone');

            $exists = Ticket::whereHas('customer', function ($query) use ($email, $phone) {
                $query->where('email', $email)
                    ->orWhere('phone', $phone);
            })
                ->where('created_at', '>=', Carbon::now()->subDay())
                ->exists();

            if ($exists) {
                $validator->errors()->add(
                    'email',
                    'Only one request per day is allowed for this email or phone number.'
                );
            }
        });
    }


}
