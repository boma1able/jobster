<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_active_at',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'last_active_at' => 'datetime',
        ];
    }

    public function product()
    {
        return $this-> hasMany(Product::class);
    }

    public function post ()
    {
        return $this -> hasMany( Post::class);
    }

    public function jobs ()
    {
        return $this->hasMany(Job::class, 'user_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function isAdmin(){

        return $this->roles()->where('name', 'Admin')->exists();
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            if ($user->roles()->count() == 0) {
                $subscriberRole = Role::where('name', 'Subscriber')->first();
                if ($subscriberRole) {
                    $user->roles()->attach($subscriberRole->id);
                }
            }
        });
    }
}
