<?php

use Illuminate\Database\Seeder;
use App\Repositories\Models\Role;
use Carbon\Carbon;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$created_at = (new Carbon())->toDateString();
    	$updated_at = (new Carbon())->toDateString();
    	$data = [
    		[
    			'name' => '管理员',
    			'slug' => 'admin',
    			'description' => '系统最高权限',
    			'level' => 1,
    			'status' => 1,
    			'created_at' => $created_at,
    			'updated_at' => $updated_at,
    		]
    	];
        Role::insert($data);
    }
}
