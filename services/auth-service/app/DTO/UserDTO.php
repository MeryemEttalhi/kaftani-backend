<?php

namespace App\DTO;

use App\Models\User;

final readonly class UserDTO
{
    public function __construct(
        public string $id,
        public string $fullName,
        public string $email,
        public ?string $phone,
        public string $role,
        public string $status,
        public bool $emailVerified,
        public string $createdAt,
    ) {
    }

    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            fullName: $user->full_name,
            email: $user->email,
            phone: $user->phone,
            role: $user->role,
            status: $user->status,
            emailVerified: $user->email_verified,
            createdAt: $user->created_at->toIso8601String(),
        );
    }

    public function toArray(): array
    {
        return [
            'id'             => $this->id,
            'full_name'      => $this->fullName,
            'email'          => $this->email,
            'phone'          => $this->phone,
            'role'           => $this->role,
            'status'         => $this->status,
            'email_verified' => $this->emailVerified,
            'created_at'     => $this->createdAt,
        ];
    }
}
