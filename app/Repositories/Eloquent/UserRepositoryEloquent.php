<?php

namespace App\Repositories\Eloquent;

use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\UserRepository;
use App\User;

use LaraveRedis, Carbon\Carbon;

use App\Traits\EloquentTrait;

/**
 * Class RoleRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository{
    use EloquentTrait;
    
    public function __construct(Application $app){
        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
 