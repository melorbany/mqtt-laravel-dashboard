<?php


namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: orbany
 * Date: 1/9/17
 * Time: 2:21 PM
 */
interface ComponentInterface
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
     * @return mixed
     */
    public function maxSerial();

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $unit_id
     * @param array $data
     * @return mixed
     */
    public function update($unit_id , array $data);

}