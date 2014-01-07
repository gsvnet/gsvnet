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
	 * Fillable fields
	 * @var array
	 */
	protected $fillable = array('username', 'firstname', 'middlename', 'lastname', 'email', 'password', 'type');

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
		return $this->firstname . ' ' . $this->middlename . ' ' . $this->lastname;
	}

	/**
	 * Set the password to be hashed when saved
	 */
	public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
    }

	public function committees()
	{
		return $this->belongsToMany('Model\Committee', 'committee_user')
                    ->withPivot('start_date', 'end_date');
	}

	public function committeesSorted()
	{
		return $this->belongsToMany('Model\Committee', 'committee_user')
                    ->withPivot('start_date', 'end_date')
                    ->orderBy('committee_user.end_date', 'desc');
	}

	public function profile()
	{
		return $this->hasOne('Model\UserProfile');
	}

	public function isMember()
	{
		return $this->type == 3 || $this->type == 4;
	}

	/**
	 * Determine the user's capacities
	 */
	public function can($action = '')
	{

		switch($action)
		{
			case 'viewMemberlist':
				return $this->isMember();
			break;
			case 'createFiles':
			case 'createPhotos':
			default:
				// TODO: Maybe an error here?
				return false;
			break;
		}
	}

	public function activeCommittees()
	{
		return $this->belongsToMany('Model\Committee', 'committee_user')
                    ->where('end_date', null)
                    ->orWhere('end_date', '>=', new \DateTime('now'))
                    ->withPivot('start_time', 'end_time');
	}
}