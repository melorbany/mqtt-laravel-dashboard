<?php


namespace App\Repositories;
use App\Models\Switches;
use App\Models\Unit;
use Log;

/**
 * Created by PhpStorm.
 * User: orbany
 * Date: 1/9/17
 * Time: 2:21 PM
 */
class SwitchRepository implements SwitchInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        try{

            return Switches::find($id);

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

        return null;
    }

    /**
     * @param $unit_id
     * @param array $select
     * @return null
     */
    public function all($unit_id , array $select = [])
    {
        try{

            $switches = Switches::where('unit_id',$unit_id) ;

            if(count($select)>0){
                $switches = $switches->select($select);
            }

            return $switches->get();

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

            return Switches::max('serial');

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

            return Switches::create($data);

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