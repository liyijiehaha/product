<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ads extends Model
{
	use SoftDeletes;
   	protected $table = 'ads';
   	public $timestamps = false;
   	protected  $primaryKey='ads_id';
   	protected $dates = ['deleted_at'];
}
