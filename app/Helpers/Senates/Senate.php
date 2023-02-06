<?php namespace GSV\Helpers\Senates;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Model;

class Senate extends Model {

	use PresentableTrait;

    protected $guarded = array();

    public static $rules = array();

    public $presenter = 'GSV\Helpers\Senates\SenatePresenter';

    public function members()
    {
        return $this->belongsToMany('GSV\Helpers\Users\User', 'user_senate')
            ->withPivot('function')->orderBy('function', 'ASC');
    }
}