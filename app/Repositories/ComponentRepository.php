<?php


namespace App\Repositories;
use App\Models\Component;
use Log;

/**
 * Created by PhpStorm.
 * User: orbany
 * Date: 1/9/17
 * Time: 2:21 PM
 */
class ComponentRepository implements ComponentInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        try{
            return Component::find($id);

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

            $component = Component::where('unit_id',$unit_id) ;

            if(count($select)>0){
                $component = $component->select($select);
            }

            return $component->get();

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

            return Component::max('serial');

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

            return Component::create($data);

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