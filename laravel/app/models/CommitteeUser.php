<?php namespace Model;

class CommitteeUser extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'committee_user';
	protected $fillable = array('start_date', 'end_date');



	public function user()
	{
		return $this->belongsTo('Model\User');
	}

	public function committee()
	{
		return $this->belongsTo('Model\Committee');
	}
}