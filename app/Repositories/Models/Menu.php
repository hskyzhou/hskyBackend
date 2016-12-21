<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Menu extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['title', 'slug', 'route', 'icon', 'status', 'desc', 'uri', 'high_uri'];

    public function parentMenu(){
    	return $this->belongsToMany(Menu::class, 'menu_relations', 'menu_id', 'menu_parent_id');
    }

    public function sonMenus(){
    	return $this->belongsToMany(Menu::class, 'menu_relations', 'menu_parent_id', 'menu_id')
                    ->withPivot('sort')
                    ->orderBy('pivot_sort', 'asc');
    }

    public function activeSonMenus(){
        return $this->belongsToMany(Menu::class, 'menu_relations', 'menu_parent_id', 'menu_id')
                    ->where('status', getStatusActive())
                    ->withPivot('sort')
                    ->orderBy('pivot_sort', 'asc');
    }

    public function permission(){
    	return $this->hasOne(Permission::class, 'slug', 'slug');
    }
}
