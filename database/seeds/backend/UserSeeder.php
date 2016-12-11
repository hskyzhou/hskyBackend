<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Repositories\Models\Role;
use Carbon\Carbon;

class UserSeeder extends Seeder
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
        $adminData = [
    		'name' => 'hsky',
    		'email' => 'hsky@hsky.me',
    		'password' => bcrypt('123456'),
    		'created_at' => $created_at,
    		'updated_at' => $updated_at,
        ];

        $admin = User::create($adminData);
        $admin->roles()->attach(Role::where('slug', 'admin')->first());
    }
}
