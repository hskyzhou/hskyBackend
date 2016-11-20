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
}
