<?php


namespace App\Repositories;
use App\Models\Unit;
use Log;

/**
 * Created by PhpStorm.
 * User: orbany
 * Date: 1/9/17
 * Time: 2:21 PM
 */
class UnitRepository implements UnitInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        try{

            return Unit::find($id);

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        try{

            return Unit::all();

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function maxSerial()
    {
        try{

            return Unit::max('serial');

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

        return null;
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        try{

            return Unit::create($data);

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

        return null;
    }

    /**
     * @param $unit_id
     * @param array $data
     * @return mixed
     */
    public function update($unit_id, array $data)
    {
        // TODO: Implement update() method.
    }


}