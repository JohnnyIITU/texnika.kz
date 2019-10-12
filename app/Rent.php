<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Rent extends Model
{
    const STATUS_TYPE_ACTIVE = 'active';
    const STATUS_TYPE_DEACTIVE = 'deactive';
    const STATUS_TYPE_TRASH = 'trash';

    public static function getActiveAndNewOrders(){
        $rents = self::where('status', self::STATUS_TYPE_ACTIVE)
            ->limit(3)
            ->orderBy('created_at')
            ->latest()
            ->get();
        $result = [];
        foreach ($rents as $rent){
            array_push($result, [
                'id' => $rent->id,
                'title' => Mark::getMarkById($rent->mark).' '.$rent->model,
                'price' => self::getPrice($rent->price, $rent->curr),
                'city' => City::getCityById($rent->city),
                'date' => self::getDate($rent->created_at),
                'image_data' => self::getImage($rent->id),
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
        if(sizeof(Storage::files('public/images/rent/'.$id)) > 0){
            $path = Storage::files('public/images/rent/'.$id)[0];
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

    public function getImages(){
        $result = [];
        if(sizeof(Storage::files('public/images/rent/'.$this->id)) > 0){
            $path = Storage::files('public/images/rent/'.$this->id);
            foreach ($path as $img){
                $img = substr($img, 7);
                array_push($result, (string)"/storage/{$img}");
            }
        }
        return $result;
    }

    public function getMarkAndModelLabel(){
        $mark = Mark::find($this->mark)->value ?? "";
        return "$mark $this->model";
    }
}
