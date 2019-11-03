<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function create(){
        return view('service.create');
    }

    public function save(Request $request){
        if($request->email === null && $request->phone === null){
            $result = [
                'error' => true,
                'error_text' => 'Укажите email или номер телефона'
            ];
            return response()->json($result)->withCallback($request->input('callback'));
        }

        $model = new Service();
        $model->status = Service::STATUS_TYPE_ACTIVE;
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
                $path = "/public/images/service/{$model->id}/";
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

        $model = new Service();
        $model->status = Service::STATUS_TYPE_TRASH;
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
                $path = "/public/images/service/{$model->id}/";
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
        return view('service.search');
    }

    public function view($id){
        $info = Service::findOrFail($id);
        $imageUrl = $info->getImages();
        return view('service.view', compact('info'), compact('imageUrl'));
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
        $count = sizeof(Service::where($condition)->get());
        if($last_index != 0){
            array_push($condition, ['id', '<', $last_index]);
        }
        $objects = Service::where($condition)
            ->orderBy('id', 'desc')
            ->paginate(9);
        foreach ($objects as $Service){
            array_push($pageData, [
                'id' => $Service->id,
                'title' => Mark::getMarkById($Service->mark).' '.$Service->model,
                'price' => Service::getPrice($Service->price, $Service->curr),
                'city' => City::getCityById($Service->city),
                'date' => Service::getDate($Service->created_at),
                'image_data' => Service::getImage($Service->id),
                'description' => $Service->description
            ]);
            $last_index = ($Service->id < $last_index || $last_index === 0) ? $Service->id : $last_index;
        }
        $result = [
            'data' => array_reverse($pageData),
            'last_index' => $last_index,
            'count' => $count,
        ];

        return response()->json($result)->withCallback($request->input('callback'));
    }
}
?>