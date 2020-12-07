<?php

namespace App;

//use Illuminate\Auth\Notifications\ResetPassword as ResetPassword;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'two_factor_type', 'phone_number', 'is_superuser', 'is_staff', 'id'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasTwoFactorAuthenticatedEnabled()
    {
        return $this->two_factor_type !== 'off';
    }

    public function activeToken()
    {
        return $this->hasMany(ActiveToken::class);
    }

    public function hasTwoFactor($key)
    {
        return $this->two_factor_type == $key;
    }

    public function hasSmsTwoFactorAuthenticationEnabled()
    {
        return $this->two_factor_type == 'sms';
    }

    public function isSuperUser()
    {
        return $this->is_superuser;
    }

    public function isStaffUser()
    {
        return $this->is_staff;
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function hasPermission($permission)
    {
//        dd($this->permissions);
        return $this->permissions->contains('name', $permission->name) || $this->hasRole($permission->roles);
    }

    public function hasRole($roles)
    {
        return !!$roles->intersect($this->roles)->all();
    }

}

