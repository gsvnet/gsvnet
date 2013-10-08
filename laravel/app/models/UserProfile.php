<?php namespace Model;

class UserProfile extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_profiles';



	public function yearGroup()
	{
		return $this->belongsTo('Model\YearGroup');
	}

	public function user()
	{
		return $this->belongsTo('Model\User');
	}
}