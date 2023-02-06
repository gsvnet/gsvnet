<?php namespace App\Helpers\Users;

use App\Helpers\Forum\Replies\Reply;
use App\Helpers\Forum\Threads\Thread;
use App\Helpers\Users\ProfileActions\ProfileAction;
use App\Helpers\Users\Profiles\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laracasts\Presenter\PresentableTrait;

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
    protected $fillable = ['username', 'firstname', 'middlename', 'lastname', 'email', 'password', 'type', 'verified'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    protected $presenter = UserPresenter::class;

    // User types
    const VISITOR = 0;
    const POTENTIAL = 1;
    const MEMBER = 2;
    const REUNIST = 3;
    const INTERNAL_COMMITTEE = 4;
    const EXMEMBER = 5;

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

    public function committees()
    {
        return $this->belongsToMany('App\Helpers\Committees\Committee', 'committee_user')
                    ->withPivot('start_date', 'end_date')
                    ->withTimestamps();
    }


    public function committeesSorted()
    {
        // Maybe ->withTimestamps(); ?
        return $this->belongsToMany('App\Helpers\Committees\Committee', 'committee_user')
                    ->withPivot('start_date', 'end_date')
                    ->orderBy('committee_user.end_date', 'desc');
    }

    public function senates()
    {
        return $this->belongsToMany('App\Helpers\Senates\Senate', 'user_senate')
                    ->withPivot('function')
                    ->withTimestamps();
    }

    public function activeSenate()
    {
        return $this->belongsToMany('App\Helpers\Senates\Senate', 'user_senate')
            ->where('start_date', '<=', new \DateTime('now'))
            ->where(function($q) {
                return $q->where('end_date', '>=', new \DateTime('now'))
                         ->orWhereNull('end_date');
            })
            ->withPivot('function');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function profileChanges()
    {
        return $this->hasMany(ProfileAction::class, 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function parents()
    {
        return $this->belongsToMany(self::class, 'family_relations', 'child_id', 'parent_id');
    }

    public function children()
    {
        return $this->belongsToMany(self::class, 'family_relations', 'parent_id', 'child_id');
    }

    public function isMember()
    {
        return $this->type == static::MEMBER;
    }

    public function wasOrIsMember()
    {
        return in_array($this->type, [static::MEMBER, static::REUNIST, static::EXMEMBER]);
    }

    public function isFormerMember()
    {
        return $this->type == static::REUNIST || $this->type == static::EXMEMBER;
    }

    public function isMemberOrReunist()
    {
        return $this->type == static::MEMBER || $this->type == static::REUNIST;
    }

    public function isPotential()
    {
        return $this->type == static::POTENTIAL;
    }

    public function isReunist()
    {
        return $this->type == static::REUNIST;
    }

    public function isExMember()
    {
        return $this->type == static::EXMEMBER;
    }

    public function isVisitor()
    {
        return $this->type == static::VISITOR;
    }

    public function isVerified()
    {
        return (bool) $this->verified;
    }

    public function activeCommittees()
    {
        return $this->belongsToMany('App\Helpers\Committees\Committee', 'committee_user')
            ->where('committee_user.start_date', '<=', new \DateTime('now'))
            ->where(function($q) {
                return $q->where('committee_user.end_date', '>=', new \DateTime('now'))
                    ->orWhereNull('committee_user.end_date');
            })
            ->withPivot('start_date', 'end_date');
    }
}