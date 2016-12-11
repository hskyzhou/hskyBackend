<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterSlugCriteria
 * @package namespace App\Repositories\Criteria;
 */
class FilterSlugCriteria implements CriteriaInterface
{
    protected $slug;
    public function __construct($slug){
        $this->slug = $slug;
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
        return $model->where('slug', $this->slug);
    }
}
