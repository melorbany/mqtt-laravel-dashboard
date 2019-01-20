<?php


namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: orbany
 * Date: 1/9/17
 * Time: 2:21 PM
 */
class UserRepository implements UserInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $user = null;

        try {
        $user = app('db')->table('users')
            ->where('id', $id)
            ->first();
        } catch (\Exception $e) {
            app('log')->error("UserRepository-> getById ".$e->getMessage());
        }

        return $user;
    }

    /**
     * @param $imei
     * @return mixed
     */
    public function getByIMEI($imei)
    {
        $user = null;
        try {

            $user = app('db')->table('users')
                ->where('imei', $imei)
                ->first();

        } catch (\Exception $e) {
            app('log')->error("UserRepository-> getByIMEI ".$e->getMessage());
        }

        return $user;
    }


    /**
     * @param array $data
     * @return int
     */
    public function create(array $data)
    {
        try {

            $user_id = app('db')->table('users')
                ->insertGetId($data);
        } catch (\Exception $e) {
            app('log')->error("UserRepository-> create ".$e->getMessage());
            $user_id = 0;
        }

        return $user_id;
    }

    /**
     * @param $user_id
     * @param array $data
     * @return bool
     */
    public function update($user_id , array $data)
    {
        try {
            app('db')->table('users')
                ->where('id', $user_id)
                ->update($data);

            return true;

        } catch (\Exception $e) {
            app('log')->error("UserRepository-> update ".$e->getMessage());
            return false;
        }

    }

}