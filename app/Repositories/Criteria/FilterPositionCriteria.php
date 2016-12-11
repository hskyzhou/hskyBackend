<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterPositionCriteria
 * @package namespace App\Repositories\Criteria;
 */
class FilterPositionCriteria implements CriteriaInterface
{
    protected $position;
    public function __construct($position){
        $this->position = $position;
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
        return $model->where("position", $this->position);
    }
}
