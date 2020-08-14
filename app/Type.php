<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function cardType()
    {
        return $this->belongsTo('App\CardType');
    }
}
