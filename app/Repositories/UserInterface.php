<?php


namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: orbany
 * Date: 1/9/17
 * Time: 2:21 PM
 */
interface UserInterface
{

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $imei
     * @return mixed
     */
    public function getByIMEI($imei);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $user_id
     * @param array $data
     * @return mixed
     */
    public function update($user_id , array $data);

}