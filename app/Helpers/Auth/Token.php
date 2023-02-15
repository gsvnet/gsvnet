<?php

namespace App\Helpers\Auth;

use App\Helpers\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laracasts\Presenter\PresentableTrait;

class Token extends Model
{
    use PresentableTrait;

    public $table = 'invitation_tokens';

    public $incrementing = false;

    public $timestamps = false;

    protected $primaryKey = 'token';

    protected $dates = ['expires_on'];

    protected $fillable = ['user_id', 'expires_on', 'token'];

    protected $presenter = TokenPresenter::class;

    public static $expire = 60 * 24 * 30; // minutes

    public function scopeActive($query)
    {
        return $query->where('expires_on', '>=', Carbon::now()->toDateTimeString());
    }

    public function account()
    {
        return $this->belongsTo(User::class);
    }

    public function prolong()
    {
        $this->expires_on = static::generateExpireDate();

        return $this;
    }

    public static function initiateFor(User $user)
    {
        $token = new static ([
            'user_id' => $user->id,
            'expires_on' => static::generateExpireDate(),
            'token' => Str::random(16),
        ]);

        return $token;
    }

    public static function generateExpireDate()
    {
        return Carbon::now()->addMinutes(self::$expire);
    }
}
