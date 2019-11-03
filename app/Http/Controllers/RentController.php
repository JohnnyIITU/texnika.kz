<?php

namespace App\Http\Controllers;

use App\City;
use App\Mark;
use App\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentController extends Controller
{
    public function create(){
        return view('rent.create');
    }

    public function save(Request $request){
        if($request->email === null && $request->phone === null){
            $result = [
                'error' => true,
                'error_text' => 'Укажите email или номер телефона'
            ];
            return response()->json($result)->withCallback($request->input('callback'));
        }

        $model = new Rent();
        $model->status = Rent::STATUS_TYPE_ACTIVE;
        foreach ($request->all() as $key => $value){
            if($key !== 'images')
            $model->$key = $value;
        }
        try{
            $model->save();
        }catch (\Exception $ex){
            $result = [
                'error' => true,
                'error_text' => $ex->getMessage(),
            ];
            return response()->json($result)->withCallback($request->input('callback'));
        }

        try {
            if ($request->images) {
                $path = "public/images/rent/{$model->id}/";
                Storage::makeDirectory($path);
                foreach ($request->images as $image) {
                    $image->store($path);
                }
            }
        }catch (\Exception $ex){
            $result = [
                'error' => true,
                'error_text' => $ex->getMessage()
            ];
            return response()->json($result)->withCallback($request->input('callback'));
        }
        $result = [
            'error' => false,
            'error_text' => null,
        ];
        return response()->json($result)->withCallback($request->input('callback'));
    }

    public function saveToTrash(Request $request){
        if($request->email === null && $request->phone === null){
            $result = [
                'error' => true,
                'error_text' => 'Укажите email или номер телефона'
            ];
            return response()->json($result)->withCallback($request->input('callback'));
        }

        $model = new Rent();
        $model->status = Rent::STATUS_TYPE_TRASH;
        foreach ($request->all() as $key => $value){
            if($key !== 'images')
                $model->$key = $value;
        }
        try{
            $model->save();
        }catch (\Exception $ex){
            $result = [
                'error' => true,
                'error_text' => $ex->getMessage(),
            ];
            return response()->json($result)->withCallback($request->input('callback'));
        }

        try {
            if ($request->images) {
                $path = "public/images/rent/{$model->id}/";
                Storage::makeDirectory($path);
                foreach ($request->images as $image) {
                    $image->store($path);
                }
            }
        }catch (\Exception $ex){
            $result = [
                'error' => true,
                'error_text' => $ex->getMessage()
            ];
            return response()->json($result)->withCallback($request->input('callback'));
        }
        $result = [
            'error' => false,
            'error_text' => null,
        ];
        return response()->json($result)->withCallback($request->input('callback'));
    }

    public function index(){
        return view('rent.search');
    }

    public function getObjects(Request $request){
        $pageData = [];
        $last_index = $request->lastindex ?? 0;
        $condition = [];
        if($request->city != 0){
            array_push($condition, ['city',$request->city]);
        }
        if($request->mark != 0){
            array_push($condition, ['mark',$request->mark]);
        }
        if($request->type != 0){
            array_push($condition, ['type',$request->type]);
        }
        if($request->priceFrom != 0){
            array_push($condition, ['price','>', $request->priceFrom]);
        }
        if($request->priceTo != 0){
            array_push($condition, ['price','<', $request->priceTo]);
        }
        $count = sizeof(Rent::where($condition)->get());
        if($last_index != 0){
            array_push($condition, ['id', '<', $last_index]);
        }
        $objects = Rent::where($condition)
            ->orderBy('id', 'desc')
            ->limit(9)
            ->get();
        foreach ($objects as $rent){
            array_push($pageData, [
                'id' => $rent->id,
                'title' => Mark::getMarkById($rent->mark).' '.$rent->model,
                'price' => Rent::getPrice($rent->price, $rent->curr),
                'city' => City::getCityById($rent->city),
                'date' => Rent::getDate($rent->created_at),
                'image_data' => Rent::getISamage($rent->id),
                'description' => $rent->description
            ]);
            $last_index = ($rent->id < $last_index || $last_index === 0) ? $rent->id : $last_index;
        }
        $result = [
            'data' => array_reverse($pageData),
            'last_index' => $last_index,
            'count' => $count,
        ];

        return response()->json($result)->withCallback($request->input('callback'));
    }

    public function view($id){
        $info = Rent::findOrFail($id);
        $imageUrl = $info->getImages();
        return view('rent.view', compact('info'), compact('imageUrl'));
    }
}
