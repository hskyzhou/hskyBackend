<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterEmailCriteria
 * @package namespace App\Repositories\Criteria;
 */
class FilterEmailCriteria implements CriteriaInterface
{
    protected $email;
    public function __construct($email){
        $this->email = $email;
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
        return $model->where('email', $this->email);
    }
}
