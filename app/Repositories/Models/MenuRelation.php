<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class MenuRelation extends Model
{
    protected $fillable = ['menu_id', 'menu_parent_id'];
}
