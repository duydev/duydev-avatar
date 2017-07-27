<?php

use Illuminate\Database\Seeder;

use DuyDev\Repositories\RolesRepository as Role;

class RolesTableSeeder extends Seeder
{
    private $role;

    /**
     * RolesTableSeeder constructor.
     * @param $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['name'=>'Root Admin'],
            ['name'=>'Admin'],
            ['name'=>'User'],
        ];

        foreach ($datas as $data) {
            $this->role->create($data);
        }
    }
}
