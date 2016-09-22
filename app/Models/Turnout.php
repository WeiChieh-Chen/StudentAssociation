<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Turnout extends Model
{
    protected $table = 'turnouts';

    public $timestamps = false;

    protected $fillable=[
        'item'
    ];

    public function items() {
    //  return $this->hasOne('Class', 'foreign_key', 'local_key');
        return $this->hasOne(Item::class,'itemId','id');
    }
}
