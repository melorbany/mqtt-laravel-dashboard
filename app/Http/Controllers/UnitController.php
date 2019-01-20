<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Libraries\phpMQTT;
use App\Models\Building;
use App\Models\Unit;
use App\Repositories\ButtonInterface;
use App\Repositories\ComponentInterface;
use App\Repositories\SwitchInterface;
use App\Repositories\UnitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * UnitController constructor.
     */

    protected $unitRepository;
    protected $componentRepository;
    protected $switchRepository;
    protected $buttonRepository;


    public function __construct(UnitRepository $unit, ComponentInterface $component,
                                SwitchInterface $switch ,ButtonInterface $button)
    {
        $this->unitRepository = $unit;
        $this->switchRepository = $switch;
        $this->componentRepository = $component;
        $this->buttonRepository = $button;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        return view('units.index',['units'=>$units]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $buildings = Building::all();
        return view('units.edit',['buildings'=>$buildings]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = $request->get('id') ;
        $unit = $this->unitRepository->get($id);
        if(isset($unit)){
            return redirect('/units/create');
        }


        $data = [
          'id' => $id,
          'building_id' => $request->get('building') ,
          'title' => $request->get('title') ,
          'description' => $request->get('description') ,
           'user_id' => Auth::user()->id,
        ];


        $this->unitRepository->create($data);

        return redirect('/units');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //


        $unit = $this->unitRepository->get($id);

        $component_types = config('component.types');

        $switch_types = config('switch.types');


        $components = $this->componentRepository->all($id);;
        $switches = $this->switchRepository->all($id);


        return view('units.view',['unit'=>$unit ,
            'component_types'=> $component_types,
            'switch_types'=> $switch_types,
            'switches' => $switches,
            'components'=> $components]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @param $id
     * @return string
     */
    public function program($id)
    {

        $components = $this->componentRepository->all($id,['id','type','title','details']);
        $switches = $this->switchRepository->all($id,['id','type','modbus']);


        $components_data = [];
        foreach ($components as $component)
        {

            $components_data[] = [
                'id' => $component->id,
                'type' => $component->type,
                'title'=>$component->title,
                'details' => json_decode($component->details)
            ];
        }


        $switches_data = [];
        foreach ($switches as $switch)
        {

            $buttons = $this->buttonRepository->all($switch->id,['register','component_id']);
            $switches_data[] = [
                'id' => $switch->id,
                'type' => $switch->type,
                'modbus'=>$switch->modbus,
                'buttons' => $buttons
            ];
        }


        $data = [
            'id' => $id,
            'components' => $components_data,
            'switches' => $switches_data,
        ];


        $data_json = json_encode($data);

        $mqtt = new phpMQTT("localhost", 1884, "admin.hms.com");

        if ($mqtt->connect()) {
            $mqtt->publish("/adn/a","Hello World! at ".date("r"),0);
            $mqtt->publish("/adn/a",$data_json,1);
            $mqtt->close();
        }


        return $data_json;
    }
}
