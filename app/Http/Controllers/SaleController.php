<?php

namespace App\Http\Controllers;

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
                $path = "/images/sale/{$model->id}/";
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
                $path = "/images/sale/{$model->id}/";
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

    public function test(){
        $full_path = Storage::files('images/Sale/1')[0];
        $full_path = Storage::path($full_path);
        $base64 = base64_encode(Storage::get(Storage::files('images/Sale/1')[0]));
        $image_data = 'data:'.mime_content_type($full_path) . ';base64,' . $base64;
        echo "<img src=\"{$image_data}\">";
    }
}
