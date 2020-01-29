<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{
    protected $table = 'card_types';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function cardSpecificTypes() {
        return $this->hasMany('App\CardSpecificType');
    }

    public function types() {
        return $this->hasMany('App\Type');
    }
}
