<?php

namespace App\Repositories\Criteria\Menu;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderBySortAscCriteria
 * @package namespace App\Repositories\Criteria;
 */
class OrderBySortAscCriteria implements CriteriaInterface
{
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
        return $model->orderBy('sort', 'asc');
    }
}
