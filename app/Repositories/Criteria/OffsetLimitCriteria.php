<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OffsetLimitCriteria
 * @package namespace App\Repositories\Criteria;
 */
class OffsetLimitCriteria implements CriteriaInterface
{
    protected $start;
    protected $length;
    public function __construct($start, $length){
        $this->start = $start;
        $this->length = $length;
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
        return $model->offset($this->start)->limit($this->length);
    }
}
