<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use GeniusTS\Roles\Models\Role as GeniusTSRole;

class Role extends GeniusTSRole implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}
