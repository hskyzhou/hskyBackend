<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller{
	use \App\Traits\ControllerTrait;
    
    protected $theme = '';
    protected $folder = '';

    public function __construct(){
    	$this->folder = $this->getTheme() . $this->getModule();
    }
    
    public function index(){
    	return view($this->folder . 'index');
    }
}
