<?php namespace Model;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Config;

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
                    ->withPivot('start_date', 'end_date')
                    ->withTimestamps();
	}

	public function committeesSorted()
	{
		// Maybe ->withTimestamps(); ?
		return $this->belongsToMany('Model\Committee', 'committee_user')
                    ->withPivot('start_date', 'end_date')
                    ->orderBy('committee_user.end_date', 'desc');
	}

	public function profile()
	{
		return $this->hasOne('Model\UserProfile');
	}

	/**
	 * Type 3 and 4 are members
	 */
	public function isMember()
	{
		return $this->type == Config::get('gsvnet.userTypes.member') || $this->type ==  Config::get('gsvnet.userTypes.formerMember');
	}

	public function activeCommittees()
	{
		return $this->belongsToMany('Model\Committee', 'committee_user')
                    ->where('end_date', null)
                    ->orWhere('end_date', '>=', new \DateTime('now'))
                    ->withPivot('start_time', 'end_time');
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
			break;
			case 'canView':
			break;

			default:
				App::abort(404);
			break;
		}
	}

	public function getTypeAttribute($type)
	{
		$types = Config::get('gsvnet.userTypes');
		$key = array_search ($type, $types);
		return $key;
	}
}