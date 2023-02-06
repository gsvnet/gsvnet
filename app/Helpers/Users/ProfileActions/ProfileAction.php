<?php namespace App\Helpers\Users\ProfileActions;

use DateTime;
use App\Helpers\Users\User;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class ProfileAction extends Model {
    
    use PresentableTrait;
    
    public $timestamps = false;

    protected $table = 'profile_actions';

    protected $fillable = ['user_id', 'at', 'action'];

    protected $dates = ['at'];
    
    protected $presenter = ProfileActionPresenter::class;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    static function createForUser($id, DateTime $moment, $action)
    {
        return new static([
            'user_id' => $id,
            'at' => $moment,
            'action' => $action
        ]);
    }
}