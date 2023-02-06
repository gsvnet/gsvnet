<?php namespace GSV\Helpers\Auth;

use Carbon\Carbon;
use GSV\Helpers\Users\User;
use Illuminate\Database\Eloquent\Model;
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

    static $expire = 60 * 24 * 30; // minutes

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
            'token' => str_random(16)
        ]);

        return $token;
    }

    static function generateExpireDate()
    {
        return Carbon::now()->addMinutes(self::$expire);
    }
}