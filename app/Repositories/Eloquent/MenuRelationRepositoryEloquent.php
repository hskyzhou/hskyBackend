<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\MenuRelationRepository;
use App\Repositories\Models\MenuRelation;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class MenuRelationRepositoryEloquent extends BaseRepository implements MenuRelationRepository{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MenuRelation::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
