<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'path',
        'filename',
        'user_id',
    ];

    // Many-to-one relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
