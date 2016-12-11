<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\Backend\PermissionService as Service;

use Flash;

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
    	return view($this->getView('index'));
    }

    public function datatables(){
        $permissions = $this->service->datatables();

        return response()->json($permissions);
    }

    public function create(){
        $results = $this->service->create();
        $permissions = $results['permissions'];
        return view($this->getView('create'), compact('permissions'));
    }

    public function store(\App\Http\Requests\Backend\PermissionRequest $request){
        $results = $this->service->store();
        if($results['result']){
            flash($results['message'], 'success');
            return redirect()->route('permission.index');
        }else{
            flash($results['message'], 'danger');
            return redirect()->back();
        }
    }

    public function edit($id){
        $results = $this->service->edit($id);
        
        if($results['result']){
            $info = $results['info'];
            $permissions = $results['permissions'];

            return view($this->getview('edit'), compact('info', 'permissions'));
        }else{
            return $results['message'];
        }
    }

    public function update(\App\Http\Requests\Backend\PermissionRequest $request, $id){
        $results = $this->service->update($id);

        if($results['result']){
            flash($results['message'], 'success');
            return redirect()->route('permission.index');
        }else{
            flash($results['message'], 'danger');
            return redirect()->back();
        }
    }

    /*临时删除单个*/
    public function delete($id){
        return $this->service->delete($id);
    }

    /*临时删除多个*/
    public function deleteMore(){
        return $this->service->deleteMore();
    }

    /*彻底删除单个*/
    public function destroy($id){
        return $this->service->destroy($id);
    }

    /*彻底删除多个*/
    public function destroyMore(){
        return $this->service->destroyMore();
    }
    
    /*恢复单个*/
    public function restore($id){
        return $this->service->restore($id);
    }

    /*恢复多个*/
    public function restoreMore(){
        return $this->service->restoreMore();
    }
}
