<?php namespace App\Helpers\Users;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class YearGroup extends Model {

    use PresentableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'year_groups';
    
    public $presenter = 'App\Helpers\Users\YearGroupPresenter';

    public function userProfiles() {
        return $this->hasMany('App\Helpers\Users\Profiles\UserProfile');
    }

}