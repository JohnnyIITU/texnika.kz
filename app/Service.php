<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    const STATUS_TYPE_ACTIVE = 'active';
    const STATUS_TYPE_DEACTIVE = 'deactive';
    const STATUS_TYPE_TRASH = 'trash';

    public static function getActiveAndNewOrders(){
        $services = self::where('status', self::STATUS_TYPE_ACTIVE)
            ->limit(3)
            ->orderBy('created_at')
            ->latest()
            ->get();
        $result = [];
        foreach ($services  as $service){
            array_push($result, [
                'id' => $service->id,
                'title' => Mark::getMarkById($service->mark).' '.$service->model,
                'price' => self::getPrice($service->price, $service->curr),
                'city' => City::getCityById($service->city),
                'date' => self::getDate($service->created_at),
                'image_data' => self::getImage($service->id),
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
        if(sizeof(Storage::files('public/images/service/'.$id)) > 0){
            $path = Storage::files('public/images/service/'.$id)[0];
            $path = substr($path, 7);
            return "/storage/$path";
        }else{
            return null;
        }
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
