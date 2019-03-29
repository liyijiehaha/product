<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'fx_cart';
    protected  $primaryKey='cart_id';
    public $timestamps = false;
}
