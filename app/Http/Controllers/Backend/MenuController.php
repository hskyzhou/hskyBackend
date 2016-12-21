<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\MenuRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\Backend\MenuService as Service;

class MenuController extends Controller{
    use \App\Traits\ControllerTrait;
    
    protected $service;
    protected $folder = '';

    public function __construct(Service $service){
        $this->service = $service;
        $this->folder = $this->getTheme() . $this->getModule();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // $u = "log-viewer::logs.list";
        // $regex = '/^' . str_replace(preg_quote('*'), '[^.]*?', preg_quote("log-viewer::*", '/')) . '$/';
        // $results = preg_match($regex, $u);
        // dd($results);

        $results = $this->service->index();
        $manageMenus = $results['menus'];
        $menuRelations = $results['menuRelations'];

        return view($this->getView('index'), compact('manageMenus', 'menuRelations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $results = $this->service->create();
        $parentMenu = $results['parentMenu'];
        return view($this->getView('create'), compact('parentMenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request){
        $results = $this->service->store();

        return response()->json($results);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $results = $this->service->edit($id);
        $menuInfo = $results['menuInfo'];
        $parentMenu = $results['parentMenu'];

        return view($this->getView('edit'), compact('menuInfo', 'parentMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id){
        $results = $this->service->update($id);
        return response()->json($results);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $results = $this->service->destroy($id);
        return response()->json($results);
    }

    public function sort(){
        $results = $this->service->sort();
        return response()->json($results);

    }
}
