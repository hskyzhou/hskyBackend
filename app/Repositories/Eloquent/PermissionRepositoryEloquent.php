<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PermissionRepository;
use App\Repositories\Models\Permission;
use App\Validators\PermissionValidator;

use LaraveRedis;
use Carbon\Carbon;

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
            $id = $item->id;
            return [
                'checkbox' => $this->createCheckbox($id),
                'name' => $item->name,
                'slug' => $item->slug,
                'description' => $item->description,
                'position' => $item->position,
                'created_at' => $item->created_at->toDateString(),
                'button' => $this->createButton($id, $item->status),
            ];
        });
    }

    public function datatablesCount($wheres){
        $query = $this->dealDatatableParams($wheres);

        return $query->count();
    }

    /*处理参数*/
    private function dealDatatableParams($wheres){
        $query = $this->model;

        $likeWhere = [
            $this->model->getPropName(),
            $this->model->getPropDescription()
        ];

        $eqWhere = [
            $this->model->getPropSlug(),
            $this->model->getPropPosition(),
        ];

        $dateWhere = [
            $this->model->getPropCreatedat(),
        ];


        if($wheres){
            foreach($wheres as $prop => $param){
                /*like 处理*/
                if(in_array($prop, $likeWhere)){
                    $query = $query->where($prop, 'like', "%{$param}%");
                }

                /*相等处理*/
                if(in_array($prop, $eqWhere)){
                    $query = $query->where($prop, $param);
                }

                /*日期 处理*/
                if(in_array($prop, $dateWhere)){
                    $started_at = (new Carbon($param))->startOfDay()->toDatetimeString();
                    $ended_at = (new Carbon($param))->endOfDay()->toDatetimeString();
                    $query = $query->where($prop, '>=', $started_at)->where($prop, '<=', $ended_at);
                }                
            }
        }
        return $query;
    }

    private function createButton($id, $status){
        $updateUrl = route('permission.edit', [$id]);
        $destroyUrl = route('permission.destroy', [$id]);
        $deleteUrl = route('permission.delete', [$id]);
        $restoreUrl = route('permission.restore', [$id]);

        $btnUpdate = "<a class='btn yellow btn-outline sbold' href='{$updateUrl}' data-target='#ajax' data-toggle='modal'><i class='fa fa-pencil'></i></a>";
        $btnOther = "";
        if($status == getStatusActive()){
            /*删除*/
            $btnOther .= "<a data-url='{$deleteUrl}' class='btn red btn-outline sbold filter-delete'><i class='fa fa-times'></i></a>";
        }else{
            /*彻底删除*/
            $btnOther .= "<a data-url='{$destroyUrl}' class='btn red btn-outline sbold filter-full-delete'><i class='fa fa-ban'></i></a>";
            /*恢复*/
            $btnOther .= "<a data-url='{$restoreUrl}' class='btn green btn-outline sbold filter-restore'><i class='fa fa-reply'></i></a>";
        }

        return $btnUpdate . $btnOther;
    }

    private function createCheckbox($id){
        return "<input type='checkbox' name='id[]' value='{$id}'>";
    }

    public function destroy($id){
        return $this->model->destroy($id);
    }

    public function delete($id){
        return $this->update(['status' => getStatusClose()], $id);
    }

    public function restore($id){
        return $this->update(['status' => getStatusActive()], $id);
    }

    public function deleteMore($ids){
        return $this->model
                    ->active()
                    ->whereIn($this->model->getKeyName(), $ids)
                    ->update(['status' => getStatusClose()]);
    }

    public function restoreMore($ids){
        return $this->model
                    ->close()
                    ->whereIn($this->model->getKeyName(), $ids)
                    ->update(['status' => getStatusActive()]);
    }

    public function destroyMore($ids){
        return $this->model
                    ->close()
                    ->whereIn($this->model->getKeyName(), $ids)
                    ->delete();
    }
}
