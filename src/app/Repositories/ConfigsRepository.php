<?php
/**
 * Created by PhpStorm.
 * User: duytn
 * Date: 26/07/2017
 * Time: 19:18
 */

namespace DuyDev\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class ConfigsRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'DuyDev\Config';
    }
}