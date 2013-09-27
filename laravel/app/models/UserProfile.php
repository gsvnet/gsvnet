<?php namespace Model;

class UserProfile extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_profiles';



	public function profile()
	{
		return $this->belongsTo('Model\YearGroup');
	}
}