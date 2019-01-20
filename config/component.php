<?php

return [


    'types' => [

        'light' => [
            'name' => 'Light',
            'resource_type'=>'output',
            'resource_count'=>1,
            'switch' => 1,
        ],
        'ac' => [
            'name' => 'Air Conditioner',
            'resource_type'=>'output',
            'resource_count'=>3,
            'switch' => 1,
        ],
        'dimmer' => [
            'name' => 'Light Dimmer',
            'resource_type'=>'modbus',
            'resource_count'=>1,
            'switch' => 1,
        ],
        'alarm' => [
            'name' => 'Fire Alarm',
            'resource_type'=>'input',
            'resource_count'=>1,
            'switch' => 1,
        ],
        'temp_control' => [
            'name' => 'Temperature Controller',
            'resource_type'=>'modbus',
            'resource_count'=>1,
            'switch' => 0,
        ],
        'presence_sensor' => [
            'name' => 'Presence Sensor',
            'resource_type'=>'input',
            'resource_count'=>1,
            'switch' => 0,
        ],

    ],

];
