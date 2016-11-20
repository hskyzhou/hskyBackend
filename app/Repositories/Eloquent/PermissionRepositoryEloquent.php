<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PermissionRepository;
use App\Repositories\Models\Permission;
use App\Validators\PermissionValidator;

use LaraveRedis;

/**
 * Class PermissionRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /*获取菜单权限*/
    public function menuPermissions($menu){
        $menuPermissions = [];
        if($slug = $menu->slug){
            /*菜单权限*/
            $menuId = $menu->id;
            $key = menuPermissionRedisKey($menuId);
            if(LaraveRedis::command('EXISTS', [$key])){
                $menuPermissions = collect(json_decode(LaraveRedis::command('GET', [$key]), true));
            }else{
                $menuPermissions = $this->setMenuPermissions($menu);
            }
        }

        return $menuPermissions;
    }

    public function clearMenuPermissions($menu){
        $menuId = $menu->id;
        $key = menuPermissionRedisKey($menuId);
        LaraveRedis::command('DELETE', [$key]);
    }

    public function setMenuPermissions($menu){
        $menuId = $menu->id;
        $slug = $menu->slug;
        $key = menuPermissionRedisKey($menuId);

        $menuPermission = $this->findByField('slug', $slug)->first();
        $prePermissions = $menuPermission->prePermissions()->get();
        $prePermissions->push($menuPermission);
        $menuPermissions = $prePermissions->pluck('name', 'id');

        LaraveRedis::command('SET', [$key, $menuPermissions]);

        return $menuPermissions;
    }
    /*============================================*/


    /*=============获取用户权限=========*/
    /**
     * 用户权限
     * @param        
     * @author      xezw211@gmail.com
     * @date        2016-11-15 14:42:05
     * @return        
     */
    public function userPermissions($user = ''){
        $user = getUser($user);
        $userId = $user->id;
        /*redis key*/
        $key = userPermissionRedisKey($userId);
        if(LaraveRedis::command('EXISTS', [$key])){
            $userPermissions = collect(json_decode(LaraveRedis::command('GET', [$key])));
        }else{
            /*set redis data*/
            $userPermissions = $this->setUserPermission($user);
        }

        return $userPermissions;        
    }

    public function clearUserPermissions($user){
        $user = getUser($user);
        $userId = $user->id;
        $key = userPermissionRedisKey($userId);
        LaraveRedis::command('DELETE', [$key]);
    }

    public function setUserPermission($user){
        $user = getUser($user);
        $userId = $user->id;
        $key = userPermissionRedisKey($userId);

        $userPermissions = $user->getPermissions()->pluck('name', 'id');

        LaraveRedis::command('SET', [$key, $userPermissions]);

        return $userPermissions; 
    }
    /*============================================*/


    /*获取所有权限*/
    public function permissions(){
        return $this->all();
    }

    /*权限管理列表*/
    public function permissionsManage(){
        $permissions = $this->permissions();
        $returnData = [
            'data' => [],
            'relation' => [],
        ];
        if(!$permissions->isEmpty()){
            foreach($permissions as $permission){
                $slug = $permission->slug;
                $slugs = explode('.', $slug);
                if($slugs){
                    $returnData['data'][$slugs[0]][$permission->position] = 1;
                    $returnData['relation'][$slugs[0]] = $permission->module;
                }
            }
        }

        return $returnData;
    }

    /* 权限datatables */
    public function datatables($wheres){
        $draw = request('draw', 1);

        $query = $this->dealDatatableParams($wheres);

        return $query->get()->map(function($item, $key){
            return [
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'description' => $item->description,
                'position' => $item->position,
                'created_at' => $item->created_at->toDateString(),
                'button' => $this->createButton(),
            ];
        });
    }

    public function datatablesCount($wheres){
        $query = $this->dealDatatableParams($wheres);

        return $query->count();
    }

    private function dealDatatableParams($wheres){
        $query = $this->model;

        $likeWhere = [
            $this->model->getPropName(),
            $this->model->getPropDescription()
        ];

        $eqWhere = [
            $this->model->getPropSlug(),
            $this->model->getPropPosition(),
            $this->model->getPropCreatedat(),
        ];


        if($wheres){
            foreach($wheres as $prop => $param){
                if(in_array($prop, $likeWhere)){
                    $query = $query->where($prop, 'like', "%{$param}%");
                }

                if(in_array($prop, $eqWhere)){
                    $query = $query->where($prop, $param);
                }
            }
        }
        return $query;
    }

    public function createButton(){
        return "<a href=''>修改</a> | <a href=''>删除</a>";
    }
}
