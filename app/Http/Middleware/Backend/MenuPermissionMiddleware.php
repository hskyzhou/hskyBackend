<?php

namespace App\Http\Middleware\Backend;

use Closure;

/*repositories*/
use App\Repositories\Eloquent\MenuRepositoryEloquent;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;

use App\Repositories\Exceptions\NoPermissionException;

/**
 * 访问菜单所需权限的中间件判断
 */

class MenuPermissionMiddleware{
    protected $menuRepo;
    protected $permissionRepo;

    public function __construct(MenuRepositoryEloquent $menuRepo, PermissionRepositoryEloquent $permissionRepo){
        $this->menuRepo = $menuRepo;
        $this->permissionRepo = $permissionRepo;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){  
        $user = auth()->loginUsingId(1);
        /*获取路由别名*/
        $routeName = $request->route()->getName();

        /*获取菜单访问权限*/
        $menu = $this->menuRepo->findByField('route', $routeName)->first();
        $menuPermissions = $this->permissionRepo->menuPermissions($menu);

        /*获取用户拥有权限*/
        $user = getUser();
        $userPermissions = $this->permissionRepo->userPermissions($user);

        if(!$menuPermissions->isEmpty()){
            foreach($menuPermissions as $key => $menuPermission){
                if(!$userPermissions->contains($menuPermission)){
                    throw new NoPermissionException($menuPermission);
                }
            }
        }

        return $next($request);
    }
}
