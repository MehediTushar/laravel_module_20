<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
   public $fillable=['product_id',
   'name',
   'description',
   'price',
   'stock',
   'image',
    'deleted_at',];
protected $dates = ['deleted_at'];
}
