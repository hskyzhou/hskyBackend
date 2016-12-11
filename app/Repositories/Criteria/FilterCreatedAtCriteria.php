<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterCreatedAtCriteria
 * @package namespace App\Repositories\Criteria;
 */
class FilterCreatedAtCriteria implements CriteriaInterface
{
    protected $startedAt;
    protected $endedAt;

    public function __construct($createdAt){
        $this->started_at = (new Carbon($createdAt))->startOfDay()->toDatetimeString();
        $this->ended_at = (new Carbon($createdAt))->endOfDay()->toDatetimeString();
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
        
        return $model->where('created_at', '>=', $started_at)
                     ->where('created_at', '<', $ended_at);
    }
}
