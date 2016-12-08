<?php 

namespace App\Services\Backend;

use App\Repositories\Eloquent\MenuRepositoryEloquent;
use App\Repositories\Eloquent\MenuRelationRepositoryEloquent;

use DB, Exception;

use App\Repositories\Criteria\Menu\OrderBySortAscCriteria;

class MenuService{

	protected $menuRepo;
	protected $menuRelationRepo;

	public function __construct(
		MenuRepositoryEloquent $menuRepo,
		MenuRelationRepositoryEloquent $menuRelationRepo
	){
		$this->menuRepo = $menuRepo;
		$this->menuRelationRepo = $menuRelationRepo;
	}

	public function index(){
		$menuRelations = $this->menuRelationRepo->all()->keyBy('menu_id')->keys();

		$this->menuRepo->pushCriteria(OrderBySortAscCriteria::class);
		$menus = $this->menuRepo->with('sonMenus')->all()->filter(function($item, $key) use ($menuRelations){
			if(!$menuRelations->contains($item->id)){
				return true;
			}

		 	if(!$item->sonMenus->isEmpty() && !$menuRelations->contains($item->id)){
			 	return true;
		 	}
		});

		return [
			'menus' => $menus,
			'menuRelations' => $menuRelations
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

	public function sort(){
		$returnData = [
			'result' => false,
			'message' => '排序失败'
		];
		$data = request('data');
		try {
			$dataArray = json_decode($data, true);

			if(is_array($dataArray)){
				foreach($dataArray as $key => $data){
					$this->dealSort($key, $data);
				}
			}

			$returnData = array_merge($returnData, [
				'result' => true,
				'message' => '排序成功'
			]);
		} catch (Exception $e) {
			
		}

		return $returnData;
	}

	private function dealSort($key, $data){
		
		$id = $data['id'];
		$parentMenu = $this->menuRepo->find($id);
		$parentMenu->sort = $key;
		$parentMenu->save();
		if(isset($data['children'])){
			foreach($data['children'] as $sort => $child){
				if(isset($child['children'])){
					$this->dealSort($sort, $child);

				}

				$sorts[$id] = [
					'sort' => $sort
				];

				$menuInfo = $this->menuRepo->find($child['id']);
				$menuInfo->parentMenu()->sync($sorts);
			}
		}else{
			$parentMenu->parentMenu()->sync([]);
		}
	}
}