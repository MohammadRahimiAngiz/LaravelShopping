<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveToken extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'token',
        'expired_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGenerateToken($query, $user)
    {
        if ($data = $this->getAliveTokenForUser($user)) {
            $code = $data->token;
        } else {
            do {
                $code = mt_rand(100000, 999999);
            } while ($this->checkTokenIs($user, $code));
            $user->activeToken()->create([
                'token' => $code,
                'expired_at' => now()->addMinutes(15),
            ]);
        }
        return $code;
    }

    private function checkTokenIs($user, int $code)
    {
        return !! $user->activeToken()->whereToken($code)->first();
    }

    private function getAliveTokenForUser($user)
    {
        return $user->activeToken()->where('expired_at', '>', now())->first();
    }

    public function scopeVerifyToken($query,$token,$user)
    {
        return !! $user->activeToken()->whereToken($token)->where('expired_at','>',now())->first();
    }
}
