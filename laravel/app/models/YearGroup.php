<?php namespace Model;

class YearGroup extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'year_groups';

	public function user_profiles() {
		return $this->hasMany('Model\UserProfile');
	}

}