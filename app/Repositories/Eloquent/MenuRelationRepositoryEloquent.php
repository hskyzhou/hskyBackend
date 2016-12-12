<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\MenuRelationRepository;
use App\Repositories\Models\MenuRelation;

use LaravelRedis;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class MenuRelationRepositoryEloquent extends BaseRepository implements MenuRelationRepository{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MenuRelation::class;
    }

    //|||||||||||||||||||||||||||||||||||||||||||||||||||||
    /*前置权限*/
    public function parentMenus(){
        /*redis key*/
        $key = parentMenuRedisKey();
        if(LaravelRedis::command('EXISTS', [$key])){
            $prePermissions = collect(json_decode(LaravelRedis::command('GET', [$key]), true));
        }else{
            /*set redis data*/
            $prePermissions = $this->setParentMenu();
        }

        return $prePermissions;
    }

    public function clearParentMenus(){
        $key = parentMenuRedisKey();
        LaravelRedis::command('DEL', [$key]);
    }

    public function setParentMenu(){
        $menus = $this->model->all()->keyBy('menu_id');

        $results = [];
        foreach($menus as $menuId => $menu){
            $results[$menuId] = $this->dealParentMenus($menus, $menu);
        }

        $key = parentMenuRedisKey();
        LaravelRedis::command('SET', [$key, json_encode($results)]);
        return collect($results);
    }

    private function dealParentMenus($datas, $menu){
        $results = [];
        $menuId = $menu->menu_id;
        $parentMenuId = $menu->menu_parent_id;

        $results[] = $menuId;
        if(isset($datas[$parentMenuId])){
            $results = array_merge($results, $this->dealParentMenus($datas, $datas[$parentMenuId]));
        }else{
            $results[] = $parentMenuId;
            return $results;
        }

        return array_unique($results);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
