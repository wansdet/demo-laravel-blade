<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_BLOGGER = 'ROLE_BLOGGER';
    public const ROLE_EDITOR = 'ROLE_EDITOR';
    public const ROLE_MODERATOR = 'ROLE_MODERATOR';
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_SUSPENDED = 'suspended';
    // private mixed $roles;

    public function hasRole(string $role): bool
    {
        return in_array($role, json_decode($this->roles, true), true);
    }

    public function hasAdminRole(): bool
    {
        $adminRoles = [self::ROLE_ADMIN, self::ROLE_EDITOR, self::ROLE_MODERATOR, self::ROLE_BLOGGER];
        return count(array_intersect($adminRoles, json_decode($this->roles, true))) > 0;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // One-to-many relationship with BlogPosts
    public function blogPosts() {
        return $this->hasMany(BlogPost::class, 'user_id');
    }

    // One-to-many relationship with Documents
    public function documents() {
        return $this->hasMany(Document::class, 'user_id');
    }
}
