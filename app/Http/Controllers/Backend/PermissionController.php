<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\Backend\PermissionService as Service;

class PermissionController extends Controller{
	use \App\Traits\ControllerTrait;
    
    protected $service;
    protected $theme = '';
    protected $folder = '';

    public function __construct(Service $service){
    	$this->service = $service;
    	$this->folder = $this->getTheme() . $this->getModule();
    }
    
    public function index(){
    	$permissionsManage = $this->service->permissionsManage();
    	return view($this->getView('index'), compact('permissionsManage'));
    }

    public function datatables(){
        $permissions = $this->service->datatables();

        return response()->json($permissions);
    }

    public function create(){
        return view($this->getView('add'));
    }

    public function store(\App\Http\Requests\Backend\PermissionCreateRequest $request){
        return $this->service->store();
    }

    public function edit($id){
        return '修改界面';
    }

    public function destroy($id){
        return $this->service->destroy($id);
    }

    public function delete($id){
        return $this->service->delete($id);
    }

    public function restore($id){
        return $this->service->restore($id);
    }

    /*删除多个*/
    public function deleteMore(){
        return $this->service->deleteMore();
    }

    /*恢复多个*/
    public function restoreMore(){
        return $this->service->restoreMore();
    }

    /*彻底删除多个*/
    public function destroyMore(){
        return $this->service->destroyMore();
    }
}
