<?php

namespace App\Helpers\Auth;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    public $table = 'malfonds_invites';

    public $incrementing = false;

    public $timestamps = false;

    protected $primaryKey = null;
    protected $casts = [
        'invited_at' => 'datetime',
    ];

    protected $fillable = ['host_id', 'guest_id', 'title', 'name', 'email', 'message', 'invited_at'];
}
