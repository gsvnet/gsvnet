<?php namespace GSV\Helpers\Users;

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
    
    public $presenter = 'GSV\Helpers\Users\YearGroupPresenter';

    public function userProfiles() {
        return $this->hasMany('GSV\Helpers\Users\Profiles\UserProfile');
    }

}