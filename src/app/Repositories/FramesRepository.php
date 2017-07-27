<?php
/**
 * Created by PhpStorm.
 * User: duytn
 * Date: 27/07/2017
 * Time: 18:31
 */

namespace DuyDev\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class FramesRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'DuyDev\Frame';
    }
}