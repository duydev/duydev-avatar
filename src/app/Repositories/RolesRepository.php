<?php
/**
 * Created by PhpStorm.
 * User: duytn
 * Date: 27/07/2017
 * Time: 17:38
 */

namespace DuyDev\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class RolesRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'DuyDev\Role';
    }
}