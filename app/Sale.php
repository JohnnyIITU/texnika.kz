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

    const CONDITION_STATE_NEW = 1;
    const CONDITION_STATE_MILEAGE = 2;
    const CONDITION_STATE_EMERGENCY = 3;
    const CONDITION_STATE_ANY = null;

    public static function getActiveAndNewOrders(){
        $sales = self::where('status', self::STATUS_TYPE_ACTIVE)
            ->limit(3)
            ->orderBy('created_at', 'desc')
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
        if(sizeof(Storage::files('public/images/sale/'.$id)) > 0){
            $path = Storage::files('public/images/sale/'.$id);
            $previewPath = $path[0];
            foreach ($path as $file) {
                if(strpos($file, 'preview'))
                    $previewPath = $file;
            }
            $path = substr($previewPath, 7);
            return "/storage/$path";
        }else{
            return "https://www.namepros.com/a/2018/05/106343_82907bfea9fe97e84861e2ee7c5b4f5b.png";
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

    public function getConditionOptions(){
        return [
            self::CONDITION_STATE_NEW => 'Новая',
            self::CONDITION_STATE_MILEAGE => 'С пробегом',
            self::CONDITION_STATE_EMERGENCY => 'Аварийное',
            self::CONDITION_STATE_ANY => 'Любое',
        ];
    }

    public function getImages(){
        $result = [];
        if(sizeof(Storage::files('public/images/sale/'.$this->id)) > 0){
            $path = Storage::files('public/images/sale/'.$this->id);
            foreach ($path as $img){
                $img = substr($img, 7);
                array_push($result, (string)"/storage/{$img}");
            }
        }else{
            $result = ["https://www.namepros.com/a/2018/05/106343_82907bfea9fe97e84861e2ee7c5b4f5b.png"];
        }
        return $result;
    }

    public function getMarkAndModelLabel(){
        $mark = Mark::find($this->mark)->value ?? "";
        return "$mark $this->model";
    }

}
