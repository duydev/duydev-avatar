<?php
/**
 * Created by PhpStorm.
 * User: duytn
 * Date: 26/07/2017
 * Time: 19:10
 */

namespace DuyDev\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class UsersRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'DuyDev\User';
    }
}