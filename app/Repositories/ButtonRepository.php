<?php


namespace App\Repositories;
use App\Models\Button;
use App\Models\Switches;
use App\Models\Unit;
use Log;

/**
 * Created by PhpStorm.
 * User: orbany
 * Date: 1/9/17
 * Time: 2:21 PM
 */
class ButtonRepository implements ButtonInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        try{

            return Button::find($id);

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

        return null;
    }


    /**
     * @param $switch_id
     * @param array $select
     * @return null
     */
    public function all($switch_id , array $select = [])
    {
        try{

            $button = Button::where('switch_id',$switch_id) ;

            if(count($select)>0){
                $button = $button->select($select);
            }

            return $button->get();

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

            return Button::create($data);

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

        return null;
    }

    /**
     * @param $id
     * @param array $data
     * @return null
     */
    public function update($id, array $data)
    {
        try{
            return Button::where('id',$id)->update($data);

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

        return null;
    }


}