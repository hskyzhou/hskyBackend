<?php 

namespace App\Services\Backend;

use App\Repositories\Eloquent\MenuRepositoryEloquent;

use DB, Exception;

class MenuService{

	protected $menuRepo;

	public function __construct(
		MenuRepositoryEloquent $menuRepo
	){
		$this->menuRepo = $menuRepo;
	}

	public function index(){
		$menus = $this->menuRepo->with('sonMenus')->all()->filter(function($item, $key){
			if(!$item->sonMenus->isEmpty()){
				return true;
			}
		});

		return [
			'menus' => $menus
		];
	}

	public function create(){
		$id = request('id');

		$parentMenu = $this->menuRepo->find($id);

		return [
			'parentMenu' => $parentMenu
		];
	}

	public function store(){
		$returnData = [
			'result' => false,
			'message' => '菜单添加失败'
		];
		try {
			$exception = DB::transaction(function(){
				$data = request()->all();


				if(!$menuInfo = $this->menuRepo->create($data)){
					throw new Exception("菜单添加失败");
				}

				/*绑定菜单层级关系*/
				try {
					$parentMenuId = request('parent_menu_id');
					$menuInfo->parentMenu()->attach($parentMenuId);
				} catch (Exception $e) {
					throw new Exception("绑定父级菜单失败");
				}

				return [
					'result' => true,
					'message' => '菜单添加成功'
				];
			});
			$returnData = array_merge($returnData, $exception);
		} catch (Exception $e) {
			dd($e);
			$returnData = array_merge($returnData, [
				'message' => $e->getMessage(),
			]);
		}
		return $returnData;
	}

	public function edit($id){
		$menuInfo = $this->menuRepo->find($id);
		$parentMenu = $menuInfo->parentMenu()->first();

		return [
			'menuInfo' => $menuInfo,
			'parentMenu' => $parentMenu
		];
	}

	public function update($id){
		$returnData = [
			'result' => false,
			'message' => '菜单修改失败'
		];

		$data = request()->all();
		if($this->menuRepo->update($data, $id)){
			$returnData = array_merge($returnData, [
				'result' => true,
				'message' => '菜单修改成功'
			]);
		}

		return $returnData;
	}

	public function destroy($id){
		$returnData = [
			'result' => false,
			'message' => '菜单删除失败',
		];

		
		if($this->menuRepo->delete($id)){
			$returnData = array_merge($returnData, [
				'result' => true,
				'message' => '菜单删除成功',		
			]);
		}

		return $returnData;
	}
	
}