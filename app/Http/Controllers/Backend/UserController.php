<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\Backend\UserService as Service;

class UserController extends Controller
{
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
        return view($this->getView('index'));
    }

    public function datatables(){
        $returnData = $this->service->datatables();
        return response()->json($returnData);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $results = $this->service->create();

        $roles = $results['roles'];
        $permissions = $results['permissions'];
        return view($this->getView('create'), compact('roles', 'permissions'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $results = $this->service->store();
        if($results['result']){
            flash($results['message'], 'success');
            return redirect()->route('user.index');
        }else{
            flash($results['message'], 'danger');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $results = $this->service->edit($id);

        $user = $results['user'];
        $roles = $results['roles'];
        $permissions = $results['permissions'];

        return view($this->getView('edit'), compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $results = $this->service->update($id);
        if($results['result']){
            flash($results['message'], 'success');
            return redirect()->route('user.index');
        }else{
            flash($results['message'], 'danger');
            return redirect()->back();
        }
    }

    /*逻辑删除*/
    public function delete($id){
        return $this->service->delete($id);
    }

    /*删除多个*/
    public function deleteMore(){
        return $this->service->deleteMore();
    }

    /*恢复*/
    public function restore($id){
        return $this->service->restore($id);
    }

    /*恢复多个*/
    public function restoreMore(){
        return $this->service->restoreMore();
    }

    /*彻底删除单个*/
    public function destroy($id){
        return $this->service->destroy($id);
    }

    /*彻底删除多个*/
    public function destroyMore(){
        return $this->service->destroyMore();
    }
}
