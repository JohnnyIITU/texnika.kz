<?php

namespace App\Http\Controllers;

use App\City;
use App\Mark;
use App\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RentController extends Controller
{
    public function create(){
        return view('rent.create');
    }

    public function save(Request $request){
        $result = [
            'error' => true,
            'error_text' => 'test',
        ];
        if($request->email === null && $request->phone === null){
            $result = [
                'error' => true,
                'error_text' => 'Укажите email или номер телефона'
            ];
            return response()->json($result)->withCallback($request->input('callback'));
        }
        DB::beginTransaction();
        $model = new Rent();
        $model->status = Rent::STATUS_TYPE_ACTIVE;
        foreach ($request->all() as $key => $value){
                if($key !== 'images' && $key !== 'preview') $model->$key = $value;
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
                $data = substr($request->preview, strpos($request->preview, ',') + 1);

                $data = base64_decode($data);
                Storage::disk('local')->put($path.'preview.png', $data);
            }
            DB::commit();
        }catch (\Exception $ex){
            DB::rollBack();
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
            if($key !== 'images' && $key !== 'preview') $model->$key = $value;
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
                $request->preview->storeAs($path, "preview.{$request->preview->extension()}");
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
        array_push($condition, ['status' , Rent::STATUS_TYPE_ACTIVE]);
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
        $keyWord = $request->keyWords;
        $objects = Rent::where($condition)
            ->orderBy('id', 'desc')
            ->limit(9)
            ->get();
        $count = 0;
        foreach ($objects as $rent){
            if($keyWord !== null) {
                if ($this->checkKeyWord($keyWord, $rent)) {
                    array_push($pageData, [
                        'id' => $rent->id,
                        'title' => Mark::getMarkById($rent->mark) . ' ' . $rent->model,
                        'price' => Rent::getPrice($rent->price, $rent->curr),
                        'city' => City::getCityById($rent->city),
                        'date' => Rent::getDate($rent->created_at),
                        'image_data' => Rent::getImage($rent->id),
                        'description' => $rent->description
                    ]);
                    $last_index = ($rent->id < $last_index || $last_index === 0) ? $rent->id : $last_index;
                    $count++;
                }
            }else{
                array_push($pageData, [
                    'id' => $rent->id,
                    'title' => Mark::getMarkById($rent->mark) . ' ' . $rent->model,
                    'price' => Rent::getPrice($rent->price, $rent->curr),
                    'city' => City::getCityById($rent->city),
                    'date' => Rent::getDate($rent->created_at),
                    'image_data' => Rent::getImage($rent->id),
                    'description' => $rent->description
                ]);
                $count++;
            }
        }
        $result = [
            'data' => $pageData,
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

    public function checkKeyWord($word, $model){
        $word = strtolower($word);
        $title = Mark::getMarkById($model->mark).' '.$model->model;
        $descriptions = $model->description;
        if(strpos(strtolower(" ".$title), $word)|| strpos(strtolower(" ".$descriptions), $word)){
            return true;
        }else{
            return false;
        }
    }
}
