<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardSpecificType extends Model
{
    protected $table = 'card_specific_types';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function cardType()
    {
        return $this->belongsTo('App\CardType');
    }
}
