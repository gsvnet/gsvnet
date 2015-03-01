<?php namespace GSVnet\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Config;
use Illuminate\Support\Facades\Hash;
use Laracasts\Presenter\PresentableTrait;
use Permission;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use PresentableTrait, Authenticatable, CanResetPassword;

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


    protected $presenter = 'GSVnet\Users\UserPresenter';

    // User types
    const VISITOR = 0;
    const POTENTIAL = 1;
    const MEMBER = 2;
    const FORMERMEMBER = 3;
    const INTERNAL_COMMITTEE = 4;

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

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Set the password to be hashed when saved
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function committees()
    {
        return $this->belongsToMany('GSVnet\Committees\Committee', 'committee_user')
                    ->withPivot('start_date', 'end_date')
                    ->withTimestamps();
    }


    public function committeesSorted()
    {
        // Maybe ->withTimestamps(); ?
        return $this->belongsToMany('GSVnet\Committees\Committee', 'committee_user')
                    ->withPivot('start_date', 'end_date')
                    ->orderBy('committee_user.end_date', 'desc');
    }

    public function senates()
    {
        return $this->belongsToMany('GSVnet\Senates\Senate', 'user_senate')
                    ->withPivot('function')
                    ->withTimestamps();
    }

    public function activeSenate()
    {
        return $this->belongsToMany('GSVnet\Senates\Senate', 'user_senate')
            ->where('start_date', '<=', new \DateTime('now'))
            ->where(function($q) {
                return $q->where('end_date', '>=', new \DateTime('now'))
                         ->orWhereNull('end_date');
            })
            ->withPivot('function');
    }

    public function profile()
    {
        return $this->hasOne('GSVnet\Users\Profiles\UserProfile');
    }

    public function replies()
    {
        return $this->hasMany('GSVnet\Forum\Replies\Reply');
    }

    public function threads()
    {
        return $this->hasMany('GSVnet\Forum\Threads\Thread');
    }

    public function parents()
    {
        return $this->belongsToMany('GSVnet\Users\User', 'family_relations', 'child_id', 'parent_id');
    }

    public function children()
    {
        return $this->belongsToMany('GSVnet\Users\User', 'family_relations', 'parent_id', 'child_id');
    }

    /**
     * Type 2 and 3 are members
     */
    public function isMember()
    {
        return $this->type == Config::get('gsvnet.userTypes.member') || $this->type ==  Config::get('gsvnet.userTypes.formerMember');
    }

    /**
     * Type 2 and 3 are members
     */
    public function wasOrIsMember()
    {
        return $this->type == static::MEMBER || $this->type == static::FORMERMEMBER;
    }

    public function isPotential()
    {
        return $this->type == static::POTENTIAL;
    }

    public function activeCommittees()
    {
        return $this->belongsToMany('GSVnet\Committees\Committee', 'committee_user')
            ->where('committee_user.start_date', '<=', new \DateTime('now'))
            ->where(function($q) {
                return $q->where('committee_user.end_date', '>=', new \DateTime('now'))
                    ->orWhereNull('committee_user.end_date');
            })
            ->withPivot('start_date', 'end_date');
    }

    // Tijdelijk
    public function isForumAdmin()
    {
        return Permission::has('threads.manage');
    }
}