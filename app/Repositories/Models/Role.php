<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use GeniusTS\Roles\Models\Role as GeniusTSRole;

class Role extends GeniusTSRole implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name', 'slug', 'level', 'created_at', 'updated_at', 'status'];

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

    public function getPropLevel(){
    	return 'level';
    }

    public function getPropCreatedat(){
    	return 'created_at';
    }

    public function getPropStatus(){
        return 'status';
    }
}
