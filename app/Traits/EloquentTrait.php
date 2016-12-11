<?php 

namespace App\Traits;

use App\Repositories\Criteria\StatusActiveCriteria;
use App\Repositories\Criteria\StatusCloseCriteria;
use App\Repositories\Criteria\FilterIdsCriteria;
use App\Repositories\Criteria\FilterIdCriteria;

Trait EloquentTrait{
	//|||||||||||||||||||||||||||||||||||||||||||||||||||
	/**
	 * 获取总量
	 * @author      xezw211@126.com
	 * @date        2016-12-11 00:56:28
	 * @return        int
	 */    
	public function count(){
	    $this->applyCriteria();
	    $results = $this->model->count();
	    $this->resetModel();
	    return $results;
	}
	
	//|||||||||||||||||||||||||||||||||||||||||||||||||||
	/*临时删除单个*/
	public function delete($id){
	    $this->pushCriteria(new FilterIdCriteria($id));
	    return $this->dealDelete();
	}

	/*临时删除多个*/
	public function deleteMore($ids){
	    $this->pushCriteria(new FilterIdsCriteria($ids));
	    return $this->dealDelete();
	}

	private function dealDelete(){
	    $this->pushCriteria(StatusActiveCriteria::class);
	    $this->applyCriteria();

	    $data = [
	        'status' => getStatusClose()
	    ];
	    return $this->model->update($data);

	    $this->resetCriteria();
	    $this->resetModel();
	    return $results;
	}

	//||||||||||||||||||||||||||||||||||||||||||||||||||
	public function destroy($id){
	    $this->pushCriteria(new FilterIdCriteria($id));
	    return $this->dealDestory();
	}

	public function destroyMore($ids){
	    $this->pushCriteria(new FilterIdsCriteria($ids));
	    return $this->dealDestory();
	}

	private function dealDestory(){
	    $this->pushCriteria(StatusCloseCriteria::class);
	    $this->applyCriteria();

	    $results = $this->model->delete();
	    $this->resetCriteria();
	    $this->resetModel();
	    return $results;
	}

	//||||||||||||||||||||||||||||||||||||||||||||||||||
	public function restore($id){
	    $this->pushCriteria(new FilterIdCriteria($id));
	    return $this->dealRestore();
	}

	public function restoreMore($ids){
	    $this->pushCriteria(new FilterIdsCriteria($ids));
	    
	    return $this->dealRestore();
	}

	private function dealRestore(){
	    $this->pushCriteria(StatusCloseCriteria::class);
	    $this->applyCriteria();

	    $data = [
	        'status' => getStatusActive()
	    ];
	    $results = $this->model->update($data);

	    $this->resetCriteria();
	    $this->resetModel();
	    return $results;
	}
	//||||||||||||||||||||||||||||||||||||||||||||||||||
}