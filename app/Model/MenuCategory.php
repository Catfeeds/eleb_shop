<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable = [
      'name',
      'type_accumulation',
      'shop_id',
      'description',
      'is_selected',
    ];
}
