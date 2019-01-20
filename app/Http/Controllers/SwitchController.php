<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Repositories\ButtonInterface;
use App\Repositories\SwitchInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SwitchController extends Controller
{

    protected $switchRepository;
    protected $buttonRepository;

    /**
     * SwitchController constructor.
     * @param $switchRepository
     */
    public function __construct(SwitchInterface $switch , ButtonInterface $button)
    {
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


        $switch_types = config('switch.types');

        $type_data = $switch_types[$type];

        return view('switches.edit',['unit'=>$unit ,
            'type' => $type,
            'type_data'=>$type_data,
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

        $unit = $request->get('unit');
        $type = $request->get('type');

        $switch_types = config('switch.types');
        $type_data = $switch_types[$type];


        $max_serial = $this->switchRepository->maxSerial();

        $switch_id = Helpers::encryptId('switch',$max_serial+1,4);


        $data = [
            'id' => $switch_id,
            'unit_id' => $unit ,
            'title' => $request->get('title') ,
            'modbus' => $request->get('modbus') ,
            'type'=>$type,
            'description' => $request->get('description') ,
            'user_id' => Auth::user()->id,
        ];


        $this->switchRepository->create($data);

        $buttons_count = $type_data['buttons'];

        for($i = 1 ; $i <= $buttons_count ; $i++)
        {

            $button_data = [
              'switch_id'=>$switch_id,
              'title'=>  $request->get("button_t$i"),
              'register'=> $request->get("button_r$i"),
              'user_id' => Auth::user()->id,
            ];

            $this->buttonRepository->create($button_data);
        }

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
