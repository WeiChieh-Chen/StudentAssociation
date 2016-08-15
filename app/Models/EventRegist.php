<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegist extends Model
{
    protected $table = 'eventRegists';
    protected $fillable = ['name','intro','start_at','end_at'];
}
