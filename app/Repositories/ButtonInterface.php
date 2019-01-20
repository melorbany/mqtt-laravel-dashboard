<?php


namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: orbany
 * Date: 1/9/17
 * Time: 2:21 PM
 */
interface ButtonInterface
{

    /**
     * @param $id
     * @return mixed
     */
    public function get($id);

    /**
     * @param $unit_id
     * @param array $select
     * @return mixed
     */
    public function all($unit_id , array $select = []);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id , array $data);

}