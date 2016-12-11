<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterIdsCriteria
 * @package namespace App\Repositories\Criteria;
 */
class FilterIdsCriteria implements CriteriaInterface
{
    protected $ids;
    public function __construct($ids){
        $this->ids = $ids;
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
        return $model->whereIn('id', $this->ids);
    }
}
