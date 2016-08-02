<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegist extends Model
{
    protected $table = 'eventRegists';
    protected $fillable = ['name','start_at','end_at'];
}
