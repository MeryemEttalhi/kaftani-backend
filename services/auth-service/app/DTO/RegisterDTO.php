<?php

namespace App\DTO;

use Illuminate\Foundation\Http\FormRequest;

final readonly class RegisterDTO
{
    public function __construct(
        public string $fullName,
        public string $email,
        public string $password,
        public ?string $phone = null,
    ) {
    }

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            fullName: $request->validated('full_name'),
            email: $request->validated('email'),
            password: $request->validated('password'),
            phone: $request->validated('phone'),
        );
    }
}
