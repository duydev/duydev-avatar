<?php

use Illuminate\Database\Seeder;
use DuyDev\Repositories\UsersRepository as User;

class UsersTableSeeder extends Seeder
{
    private $user;

    /**
     * UsersTableSeeder constructor.
     * @param $user
     */
    public function __construct( User $user)
    {
        $this->user = $user;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'name' => 'Trần Nhật Duy',
                'email' => 'hi@duydev.me',
                'password' => bcrypt('nopass'),
            ]
        ];

        foreach ( $datas as $data ) {
            $this->user->create($data);
        }
    }
}
