<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Repositories\ButtonInterface;
use App\Repositories\ComponentInterface;
use App\Repositories\SwitchInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComponentController extends Controller
{

    protected $componentRepository;
    protected $switchRepository;
    protected $buttonRepository;

    /**
     * ComponentController constructor.
     */
    public function __construct(ComponentInterface $component ,
                                SwitchInterface $switch , ButtonInterface $button )
    {

        $this->componentRepository = $component;
        $this->switchRepository = $switch;
        $this->buttonRepository = $button;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {




        $unit = $request->get('unit');
        $type = $request->get('type');


        $component_types = config('component.types');

        $type_data = $component_types[$type];


        $switches_data = [];
        if($type_data['switch']){

            $switches = $this->switchRepository->all($unit);
            foreach ($switches as $switch)
            {

                $buttons = $this->buttonRepository->all($switch->id);
                $switches_data[] = [
                    'title' => $switch->title,
                    'buttons' => $buttons
                ];
            }

        }



        return view('components.edit',['unit'=>$unit ,
            'type' => $type,
            'type_data'=>$type_data,
            'switches_data'=>$switches_data
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


//        dd($request->get('button'));


        $unit = $request->get('unit');
        $type = $request->get('type');


        $component_types = config('component.types');

        $type_data = $component_types[$type];
        $details_data = [];

        if($type_data['resource_type'] == 'output'){

            for($i = 1 ; $i <= $type_data['resource_count'] ; $i++){
                $details_data[$i] = $request->get("output$i");
            }

            $details = [
                'resource'=>'output',
                'count' => $type_data['resource_count'],
                'data' => $details_data
            ];

        }elseif ($type_data['resource_type'] == 'input'){

            $details = [
                'resource'=>'input',
                'count' => $type_data['resource_count'],
                'data' => [1 => $request->get("input")]
            ];


        }elseif ($type_data['resource_type'] == 'modbus'){

            $details = [
                'resource'=>'modbus',
                'count' => $type_data['resource_count'],
                'data' => [1 => $request->get("modbus")]
            ];
        }

        $details = json_encode($details);

        $max_serial = $this->componentRepository->maxSerial();

        $component_id = Helpers::encryptId('component',$max_serial+1,4);


        $data = [
            'id' => $component_id,
            'unit_id' => $unit ,
            'type'=>$type,
            'title' => $request->get('title') ,
            'description' => $request->get('description') ,
            'details'=> $details,
            'user_id' => Auth::user()->id,
        ];


        $this->componentRepository->create($data);

        $button_id = $request->get('button');
        $this->buttonRepository->update($button_id , ['component_id'=> $component_id]);


        return redirect('/units/'.$unit);


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
}
