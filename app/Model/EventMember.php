<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventMember extends Model
{
    protected $fillable = ['events_id','member_id'];
}
