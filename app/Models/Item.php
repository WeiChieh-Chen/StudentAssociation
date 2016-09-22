<?php

namespace App\Models;

use App\Models\Turnout;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $primaryKey = 'itemId';

    public $timestamps = false;

    protected $fillable = [
        'itemId', 'optionName', 'fileName', 'votes', 'itemOrder'
    ];

    public function turnouts() {
        return $this->belongsTo(Turnout::class,'id','itemId');
    }
}
