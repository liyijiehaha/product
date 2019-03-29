<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'fx_order';
    public $timestamps = false;
    protected  $primaryKey='order_id';

}
