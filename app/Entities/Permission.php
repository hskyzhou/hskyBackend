<?php

namespace App\Entities;

use GeniusTS\Roles\Models\Permission as GeniusTSPermission;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Permission extends GeniusTSPermission implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}