<?php 

namespace App\Services\Backend;

use App\Repositories\Eloquent\MenuRepositoryEloquent;

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
		
	}
	
}