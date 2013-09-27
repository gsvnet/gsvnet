<?php namespace Model;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getFullnameAttribute()
	{
		return $this->firstname . ' ' . $this->lastname;
	}

	public function committees()
	{
		return $this->belongsToMany('Model\Committee', 'committee_user')
                    ->withPivot('start_time', 'end_time');
	}

	public function profile()
	{
		return $this->hasOne('Model\Profile');
	}

	// TODO example
	// public function canManagePhotos()
	// {
	// 	return $this->hasRole() || $this->hasCommittee();
	// }

	public function activeCommittees()
	{
		return $this->belongsToMany('Model\Committee', 'committee_user')
                    ->where('end_date', null)
                    ->orWhere('end_date', '>=', new \DateTime('now'))
                    ->withPivot('start_time', 'end_time');
	}
}