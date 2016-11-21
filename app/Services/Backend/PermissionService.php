<?php
	namespace App\Services\Backend;

	use App\Repositories\Eloquent\PermissionRepositoryEloquent as Permission;
	class PermissionService{

		protected $permissionRepo;

		public function __construct(Permission $permissionRepo){
				$this->permissionRepo = $permissionRepo;
		}

		public function permissionsManage(){
			return $this->permissionRepo->permissionsManage();
		}

		public function datatables(){
			$draw = request('draw', 1);

			/*处理参数*/
			$wheres = [];

			$name = request('name', '');
			if($name){
			    $wheres['name'] = $name;
			}

			$slug = request('slug', '');
			if($slug){
			    $wheres['slug'] = $slug;
			}

			$description = request('description', '');
			if($description){
			    $wheres['description'] = $description;
			}

			$position = request('position', '');
			if($position){
			    $wheres['position'] = $position;
			}

			$created_at = request('created_at', '');
			if($created_at){
			    $wheres['created_at'] = $created_at;
			}

			$datas = $this->permissionRepo->datatables($wheres);

			$count = $this->permissionRepo->datatablesCount($wheres);

			return [
	            'draw' => $draw,
	            'recordsTotal' => $count,
	            'recordsFiltered' => $count,
	            'data' => $datas
	        ];
		}

		/*彻底删除*/
		public function destroy($id){
			$returnData = [
			    'result' => false,
			    'message' => '彻底删除失败',
			];

			$info = $this->permissionRepo->find($id);

			if($info){
				if($info->status == getStatusClose()){
					if($this->permissionRepo->destroy($id)){
						$returnData = array_merge($returnData, [
		                    'result' => true,
		                    'message' => '彻底删除成功',
		                ]);
					}else{
						$returnData = array_merge($returnData, [
						    'message' => '彻底删除失败',
						]);
					}
				}else{
					$returnData = array_merge($returnData, [
	                    'result' => false,
	                    'message' => '请先删除',
	                ]);
				}
			}else{
				$returnData = array_merge($returnData, [
				    'message' => '查无记录',
				]);
			}
			
			return $returnData;
		}

		/*临时删除*/
		public function delete($id){
			$returnData = [
			    'result' => false,
			    'message' => '删除失败',
			];

			$info = $this->permissionRepo->find($id);

			if($info){
				if($this->permissionRepo->delete($id)){
					$returnData = array_merge($returnData, [
	                    'result' => true,
	                    'message' => '删除成功',
	                ]);
				}else{
					$returnData = array_merge($returnData, [
					    'message' => '删除失败',
					]);
				}
			}else{
				$returnData = array_merge($returnData, [
				    'message' => '查无记录',
				]);
			}
			
			return $returnData;
		}

		/*恢复临时删除数据*/
		public function restore($id){
			$returnData = [
				'result' => false,
				'message' => '恢复失败'
			];
			if($this->permissionRepo->restore($id)){
				$returnData = array_merge($returnData, [
					'result' => true,
					'message' => '恢复成功'
				]);
			}
			return $returnData;
		}

		public function deleteMore(){
			$returnData = [
				'result' => false,
				'message' => '删除失败'
			];
			$ids = request('ids', []);
			if(!empty($ids)){
				if($this->permissionRepo->deleteMore($ids)){
					$returnData = array_merge($returnData, [
						'result' => true,
						'message' => ' 删除成功'
					]);
				}else{
					$returnData = array_merge($returnData, [
						'message' => ' 删除失败'
					]);
				}
			}else{
				$returnData = array_merge($returnData, [
					'message' => '未选中删除记录'
				]);
			}
			return $returnData;
		}

		public function restoreMore(){
			$returnData = [
				'result' => false,
				'message' => '恢复失败',
			];

			$ids = request('ids', []);

			if(!empty($ids)){
				if($this->permissionRepo->restoreMore($ids)){
					$returnData = array_merge($returnData, [
						'result' => true,
						'message' => ' 恢复成功'
					]);
				}else{
					$returnData = array_merge($returnData, [
						'message' => ' 恢复失败'
					]);
				}
			}else{
				$returnData = array_merge($returnData, [
					'message' => '未选中恢复记录'
				]);
			}
			return $returnData;
		}

		public function destroyMore(){
			$returnData = [
				'result' => false,
				'message' => '彻底删除失败'
			];
			$ids = request('ids', []);
			if(!empty($ids)){
				if($this->permissionRepo->destroyMore($ids)){
					$returnData = array_merge($returnData, [
						'result' => true,
						'message' => ' 彻底删除成功'
					]);
				}else{
					$returnData = array_merge($returnData, [
						'message' => ' 彻底删除失败'
					]);
				}
			}else{
				$returnData = array_merge($returnData, [
					'message' => '未选中彻底删除记录'
				]);
			}
			return $returnData;
		}
	}