<?php

use Illuminate\Database\Seeder;
use DuyDev\Repositories\ConfigsRepository as Config;

class ConfigsTableSeeder extends Seeder
{
    private $config;

    /**
     * ConfigsTableSeeder constructor.
     * @param $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
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
                'key' => 'name',
                'value' => 'Avatar',
            ]
        ];

        foreach ($datas as $data) {
            $this->config->create($data);
        }

    }
}
