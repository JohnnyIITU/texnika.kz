<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Sale extends Model
{
    const STATUS_TYPE_ACTIVE = 'active';
    const STATUS_TYPE_DEACTIVE = 'deactive';
    const STATUS_TYPE_TRASH = 'trash';

    public static function getActiveAndNewOrders(){
        $sales = self::where('status', self::STATUS_TYPE_ACTIVE)
            ->limit(3)
            ->orderBy('created_at')
            ->latest()
            ->get();
        $result = [];
        foreach ($sales  as $sale){
            array_push($result, [
                'id' => $sale->id,
                'title' => Mark::getMarkById($sale->mark).' '.$sale->model,
                'price' => self::getPrice($sale->price, $sale->curr),
                'city' => City::getCityById($sale->city),
                'date' => self::getDate($sale->created_at),
                'image_data' => self::getImage($sale->id),
            ]);
        }
        return($result);
    }

    public static function getDate($date){
        $created = new Carbon($date->format('d.m.Y'));
        $today = Carbon::now();
        $difference = $created->diff($today)->days;
        switch ($difference){
            case 0 :
                $text = 'Сегодня';
                break;
            case 1 :
                $text = 'Вчера';
                break;
            case 2 :
                $text = '2 дня назад';
                break;
            case 3 :
                $text = '3 дня назад';
                break;
            default :
                $text = $date->format('d.m.Y');
        }
        return $text;
    }

    public static function getImage($id){
        $path = Storage::files('images/sale/'.$id)[0];
        $full_path = Storage::path($path);
        $base64 = base64_encode(Storage::get($path));
        $image_data = 'data:'.mime_content_type($full_path) . ';base64,' . $base64;
        return $image_data;
    }

    public static function getPrice($price, $curr){
        $price = number_format($price, 0, '', ' ');
        switch ($curr){
            case 1 :
                $text = $price.' ₸';
                break;
            case 2 :
                $text = $price.' $';
                break;
            case 3 :
                $text = $price.' €';
                break;
            case 4 :
                $text = $price. ' ₽';
                break;
        }
        return $text;

    }
}
