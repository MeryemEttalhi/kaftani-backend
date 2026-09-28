<?php

namespace App\Models;

use App\Core\Traits\HasUuid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasUuid;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'profile_photo',
        'birth_date',
        'gender',
        'language',
        'auth_provider',
        'password',
        'google_id',
        'google_email',
        'newsletter_active',
    ];

    protected $hidden = [
        'password',
        'refresh_token_hash',
        'marketing_token',
    ];

    protected function casts(): array
    {
        return [
            'password'                 => 'hashed',
            'email_verified'           => 'boolean',
            'newsletter_active'        => 'boolean',
            'birth_date'                => 'date',
            'last_login_at'             => 'datetime',
            'refresh_token_expires_at'  => 'datetime',
        ];
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'user_id', 'id');
    }

    public function activeAddresses(): HasMany
    {
        return $this->hasMany(Address::class, 'user_id', 'id')
            ->where('deleted', false);
    }

    public function otpCodes(): HasMany
    {
        return $this->hasMany(OtpCode::class, 'user_id', 'id');
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class, 'user_id', 'id');
    }
}
