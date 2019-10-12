<?php

namespace App\Http\Controllers;

use App\City;
use App\Mark;
use App\Sale;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
{
    public function create(){
        return view('sale.create');
    }

    public function save(Request $request){
        if($request->email === null && $request->phone === null){
            $result = [
                'error' => true,
                'error_text' => 'Укажите email или номер телефона'
            ];
            return response()->json($result)->withCallback($request->input('callback'));
        }

        $model = new Sale();
        $model->status = Sale::STATUS_TYPE_ACTIVE;
        foreach ($request->all() as $key => $value){
            if($key !== 'images') $model->$key = $value;
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
                $path = "public/images/sale/{$model->id}/";
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

        $model = new Sale();
        $model->status = Sale::STATUS_TYPE_TRASH;
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
                $path = "public/images/sale/{$model->id}/";
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
        return view('sale.search');
    }

    public function getConditionOptions(Request $request){
        $result = [];
        foreach ((new Sale())->getConditionOptions() as $key => $value){
            array_push($result ,[
                'key' => $key,
                'label' => $value,
                'class' => '',
            ]);
        }
        return response()->json($result)->withCallback($request->input('callback'));
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
        if($request->condition != 0){
            array_push($condition, ['condition','<', $request->condition]);
        }
        $count = sizeof(Sale::where($condition)->get());
        if($last_index != 0){
            array_push($condition, ['id', '<', $last_index]);
        }
        $objects = Sale::where($condition)
            ->orderBy('id', 'desc')
            ->paginate(9);
        foreach ($objects as $Sale){
            array_push($pageData, [
                'id' => $Sale->id,
                'title' => Mark::getMarkById($Sale->mark).' '.$Sale->model,
                'price' => Sale::getPrice($Sale->price, $Sale->curr),
                'city' => City::getCityById($Sale->city),
                'date' => Sale::getDate($Sale->created_at),
                'image_data' => Sale::getImage($Sale->id),
                'description' => $Sale->description
            ]);
            $last_index = ($Sale->id < $last_index || $last_index === 0) ? $Sale->id : $last_index;
        }
        $result = [
            'data' => array_reverse($pageData),
            'last_index' => $last_index,
            'count' => $count,
        ];

        return response()->json($result)->withCallback($request->input('callback'));
    }

}
