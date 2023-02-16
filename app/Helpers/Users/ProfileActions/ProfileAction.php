<?php

namespace App\Helpers\Users\ProfileActions;

use App\Helpers\Users\User;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class ProfileAction extends Model
{
    use PresentableTrait;

    public $timestamps = false;

    protected $table = 'profile_actions';

    protected $fillable = ['user_id', 'at', 'action'];
    protected $casts = [
        'at' => 'datetime',
    ];

    protected $presenter = ProfileActionPresenter::class;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createForUser($id, DateTime $moment, $action)
    {
        return new static([
            'user_id' => $id,
            'at' => $moment,
            'action' => $action,
        ]);
    }
}
