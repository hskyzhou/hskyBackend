<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PermissionRepository;
use App\Entities\Permission;
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
                $menuPermissions = LaraveRedis::command('GET', [$key]);
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
        $menuPermissions = $prePermissions->pluck('title', 'id');

        LaraveRedis::command('SET', [$key, $menuPermissions]);

        return $menuPermissions;
    }


    /*获取用户权限*/
    public function userPermissions($user = ''){
        $user = getUser($user);
        $userId = $user->id;
        /*redis key*/
        $key = userPermissionRedisKey($userId);
        if(LaraveRedis::command('EXISTS', [$key])){
            $userPermissions = LaraveRedis::command('GET', [$key]);
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

        $userPermissions = $user->getPermissions()->pluck('title', 'id');

        LaraveRedis::command('SET', [$key, $userPermissions]);

        return $userPermissions; 
    }
}
