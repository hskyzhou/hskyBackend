<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterDescriptionCriteria
 * @package namespace App\Repositories\Criteria;
 */
class FilterDescriptionCriteria implements CriteriaInterface
{
    protected $description;
    protected $pattern;
    public function __construct($description, $pattern = false){
        $this->description = $description;
        $this->pattern = $pattern;
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
        if($this->pattern){
            return $model->where('description', 'like', "%". $this->description ."%");
        }else{
            return $model->where('description', "%". $this->description ."%");            
        }
    }
}
