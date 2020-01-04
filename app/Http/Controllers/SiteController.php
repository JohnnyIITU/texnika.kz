<?php

namespace App\Http\Controllers;

use App\City;
use App\Equipment;
use App\Mark;
use App\ServiceType;
use App\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        return view('index');
    }

    public function getCityList(Request $request){
        $result = [];
        foreach (City::all() as $city){
            array_push($result ,[
                'key' => $city->id,
                'label' => $city->value,
                'class' => '',
            ]);
        }
        return response()->json($result)->withCallback($request->input('callback'));
    }

    public function getTypeList(Request $request){
        $result = [];
        foreach (Equipment::all() as $city){
            array_push($result ,[
                'key' => $city->id,
                'label' => $city->value,
                'class' => '',
            ]);
        }
        return response()->json($result)->withCallback($request->input('callback'));
    }

    public function getMarkList(Request $request){
        $result = [];
        foreach (Mark::all() as $city){
            array_push($result ,[
                'key' => $city->id,
                'label' => $city->value,
                'class' => '',
            ]);
        }
        return response()->json($result)->withCallback($request->input('callback'));
    }

    public function getServiceTypeList(Request $request){
        $result = [];
        foreach (ServiceType::all() as $city){
            array_push($result ,[
                'key' => $city->id,
                'label' => $city->value,
                'class' => '',
            ]);
        }
        return response()->json($result)->withCallback($request->input('callback'));
    }

    public function getYearList(Request $request){
        $result = [];
        for($i = 1990; $i <= (int)date('Y'); $i++){
            array_push($result ,[
                'key' => $i,
                'label' => $i,
            ]);
        }
        return response()->json($result)->withCallback($request->input('callback'));
    }
}
