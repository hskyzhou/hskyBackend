<?php

namespace App\Repositories\Models;

use GeniusTS\Roles\Models\Permission as GeniusTSPermission;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Permission extends GeniusTSPermission implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name', 'slug', 'description', 'model', 'position', 'status'];

    protected $dates = [
    	'created_at', 'updated_at'
    ];
}

