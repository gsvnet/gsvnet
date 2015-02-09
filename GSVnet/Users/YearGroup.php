<?php namespace GSVnet\Users;

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
    
    public $presenter = 'GSVnet\Users\YearGroupPresenter';

    public function userProfiles() {
        return $this->hasMany('GSVnet\Users\Profiles\UserProfile');
    }

}