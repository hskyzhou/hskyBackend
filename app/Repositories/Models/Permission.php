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

    public function scopeActive($query){
        return $query->where($this->getPropStatus(), getStatusActive());
    }

    public function scopeClose($query){
        return $query->where($this->getPropStatus(), getStatusClose());
    }    

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

    public function getPropStatus(){
        return 'status';
    }
}

