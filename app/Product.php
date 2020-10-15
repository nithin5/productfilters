<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    protected $table='products';
    protected $fillable=['name','image','brand','price','processor_type','screen_size'];
    use SoftDeletes;
}
