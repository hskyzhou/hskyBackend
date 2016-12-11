<?php

namespace App\Repositories\Eloquent;

use Illuminate\Container\Container as Application;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PermissionRepository;
use App\Repositories\Models\Permission;

use LaraveRedis;
use Carbon\Carbon;

use App\Repositories\Criteria\StatusActiveCriteria;
use App\Traits\EloquentTrait;
/**
 * Class PermissionRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    use EloquentTrait;
    public function __construct(Application $app){
        parent::__construct($app);
    }
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

        /*管理员*/
        if($user->isRole('admin')){
            $userPermissions = $this->model->all()->pluck('name', 'id');
        }else{
            $userId = $user->id;
            /*redis key*/
            $key = userPermissionRedisKey($userId);
            if(LaraveRedis::command('EXISTS', [$key])){
                $userPermissions = collect(json_decode(LaraveRedis::command('GET', [$key])));
            }else{
                /*set redis data*/
                $userPermissions = $this->setUserPermission($user);
            }
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

    //|||||||||||||||||||||||||||||||||||||||||||||||||||||
    /*前置权限*/
    public function prePermissions(){
        /*redis key*/
        $key = permissionRedisKey();
        if(LaraveRedis::command('EXISTS', [$key])){
            $prePermissions = collect(json_decode(LaraveRedis::command('GET', [$key])));
        }else{
            /*set redis data*/
            $prePermissions = $this->setPrePermissions();
        }

        return $prePermissions;
    }

    public function clearPrePermissions(){
        $key = permissionRedisKey();
        LaraveRedis::command('DELETE', [$key]);
    }

    public function setPrePermissions(){
        $this->pushCriteria(StatusActiveCriteria::class);
        $permissions = $this->model->with('prePermissions')->get()->keyBy('id');

        $results = [];
        foreach($permissions as $permissionId => $permission){
            $results[$permissionId] = $this->dealPrePermissions($permissions, $permission);
        }

        $key = permissionRedisKey();
        LaraveRedis::command('SET', [$key, $results]);
        return collect($results);

    }

    private function dealPrePermissions($datas, $permission){
        // echo '<pre>';
        // print_r($permission->toArray());
        $results = [];
        $permissionId = $permission->id;
        $results[] = $permissionId;
        if(!$permission->prePermissions->isEmpty()){
            foreach($permission->prePermissions as $prePermission){
                $prePermissionId = $prePermission->id;
                if(isset($datas[$prePermissionId])){
                    $results = array_merge($results, $this->dealPrePermissions($datas, $datas[$prePermissionId]));
                }else{
                    $results[] = $prePermissionId;
                    return $results;
                }
            }
        }
        return array_unique($results);
    }

    /*============================================*/
    /*显示权限列表*/
    public function permissionList(){
        $results = [];
        $permissions = $this->with(['prePermissions'])->all();

        if(!$permissions->isEmpty()){
            foreach($permissions as $permission){
                $slugs = explode('.', $permission->slug);
                $results[$slugs[0]][] = [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'slug' => $permission->slug,
                    'childs' => $permission->prePermissions
                ];
            }
        }
        return $results;
    }
}
