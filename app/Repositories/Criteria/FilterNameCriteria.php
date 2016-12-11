<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterNameCriteria
 * @package namespace App\Repositories\Criteria;
 */
class FilterNameCriteria implements CriteriaInterface
{
    protected $name;
    protected $pattern;
    public function __construct($name, $pattern = false){
        $this->name = $name;
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
            return $model->where('name', 'like', "%". $this->name ."%");
        }else{
            return $model->where('name', "%". $this->name ."%");            
        }
    }
}
