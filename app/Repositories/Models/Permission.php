<?php

namespace App\Repositories\Models;

use GeniusTS\Roles\Models\Permission as GeniusTSPermission;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Permission extends GeniusTSPermission implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $dates = [
    	'created_at', 'updated_at'
    ];

    public function getPropName(){
    	return 'name';
    }

    public function getPropSlug(){
    	return 'slug';
    }

    public function getPropDescription(){
    	return 'description';
    }

    public function getPropPosition(){
    	return 'position';
    }

    public function getPropCreatedat(){
    	return 'created_at';
    }
}
