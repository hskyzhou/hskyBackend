<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterIdCriteria
 * @package namespace App\Repositories\Criteria;
 */
class FilterIdCriteria implements CriteriaInterface
{
    protected $id;
    public function __construct($id){
        $this->id = $id;
    }
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('id', $this->id);
    }
}
