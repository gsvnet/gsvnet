<?php namespace GSVnet\Senates;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Model;

class Senate extends Model {

	use PresentableTrait;

    protected $guarded = array();

    public static $rules = array();

    public $presenter = 'GSVnet\Senates\SenatePresenter';

    public function members()
    {
        return $this->belongsToMany('GSVnet\Users\User', 'user_senate')
            ->withPivot('function')->orderBy('function', 'ASC');
    }
}