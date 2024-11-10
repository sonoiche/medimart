<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = ['display_photo','display_zip'];

    public function getDisplayPhotoAttribute()
    {
        $photo = $this->attributes['photo'] ?? '';
        if($photo) {
            return url($photo);
        }

        $fullname = $this->attributes['name'];
        if($fullname !== '') {
            return 'https://ui-avatars.com/api/?name='.$fullname.'&background=random&format=png';
        }
    }

    public function getDisplayZipAttribute()
    {
        return $this->attributes['postal_zip'] ?? '';
    }
}
