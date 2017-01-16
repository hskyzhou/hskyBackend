<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use HskyZhou\Roles\Models\Role as GeniusTSRole;

class Role extends GeniusTSRole implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name', 'slug', 'level', 'created_at', 'updated_at', 'status', 'description'];

    protected $dates = [
    	'created_at', 'updated_at'
    ];
}
