<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Equipment;
use App\Mark;
use App\Rent;
use App\Sale;
use App\Service;
use App\ServiceType;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function showLoginForm(){
        if(Auth::check()){
            return redirect('/index');
        }else {
            return view('admin.login');
        }
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $users = User::where('email', $username)
            ->where('role', 'admin')
            ->first();
        if($users === null){
            $success = false;
            $errorText = 'Неверный логин или пароль';
        }else{
            if(crypt($password, $users->password) === $users->password){
                Auth::login($users);
                $success = true;
                $errorText = '';
            }else{
                $success = false;
                $errorText = 'Неверный логин или пароль';
            }
        }

        $result = [
            'success' => $success,
            'error' => $errorText
        ];;

        return response()->json($result)->withCallback($request->input('callback'));


    }

    public function index(){
        return view('admin.index');
    }

    public function marks(){
        return view('admin.dicti.marks.list');
    }
    public function services(){
        return view('admin.dicti.services.list');
    }
    public function equipment(){
        return view('admin.dicti.equipments.list');
    }
    public function cities(){
        return view('admin.dicti.cities.list');
    }

    public function getMarks(Request $request){
        $result = [];
        foreach (Mark::all() as $item) {
            array_push($result, [
                'id' => $item->id,
                'name' => $item->value,
            ]);
        }
        return response()->json($result);
    }
    public function getServices(Request $request){
        $result = [];
        foreach (ServiceType::all() as $item) {
            array_push($result, [
                'id' => $item->id,
                'name' => $item->value,
            ]);
        }
        return response()->json($result);
    }
    public function getEquipments(Request $request){
        $result = [];
        foreach (Equipment::all() as $item) {
            array_push($result, [
                'id' => $item->id,
                'name' => $item->value,
            ]);
        }
        return response()->json($result);
    }
    public function getCities(Request $request){
        $result = [];
        foreach (City::all() as $item) {
            array_push($result, [
                'id' => $item->id,
                'name' => $item->value,
            ]);
        }
        return response()->json($result);
    }

    public function addMarkView(){
        return view('admin.dicti.marks.add');
    }
    public function addServiceView(){
        return view('admin.dicti.services.add');
    }
    public function addEquipmentView(){
        return view('admin.dicti.equipments.add');
    }
    public function addCityView(){
        return view('admin.dicti.cities.add');
    }

    public function addMark(Request $request){
        $name = $request->name;
        $data = new Mark();
        $data->value = $name;
        try{
            $data->save();
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }
    public function addService(Request $request){
        $name = $request->name;
        $data = new ServiceType();
        $data->value = $name;
        try{
            $data->save();
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }
    public function addEquipment(Request $request){
        $name = $request->name;
        $data = new Equipment();
        $data->value = $name;
        try{
            $data->save();
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }
    public function addCity(Request $request){
        $name = $request->name;
        $data = new City();
        $data->value = $name;
        try{
            $data->save();
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    public function deleteMark(Request $request){
        $data = Mark::findOrFail($request->id);
        if($data === null){
            return response()->json([
                'success' => false,
                'error' => 'Нет указанного ID'
            ]);
        }
        try{
            $data->delete();
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }
    public function deleteService(Request $request){
        $data = ServiceType::findOrFail($request->id);
        if($data === null){
            return response()->json([
                'success' => false,
                'error' => 'Нет указанного ID'
            ]);
        }
        try{
            $data->delete();
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }
    public function deleteEquipment(Request $request){
        $data = Equipment::findOrFail($request->id);
        if($data === null){
            return response()->json([
                'success' => false,
                'error' => 'Нет указанного ID'
            ]);
        }
        try{
            $data->delete();
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }
    public function deleteCity(Request $request){
        $data = City::findOrFail($request->id);
        if($data === null){
            return response()->json([
                'success' => false,
                'error' => 'Нет указанного ID'
            ]);
        }
        try{
            $data->delete();
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    public function rents(){
        return view('admin.dicti.announcements.rents');
    }
    public function aServices(){
        return view('admin.dicti.announcements.services');
    }
    public function sales(){
        return view('admin.dicti.announcements.sales');
    }

    public function getRents(){
        $result = [];
        foreach (Rent::all() as $item) {
            array_push($result, [
                'id' => $item->id,
                'mark' => Mark::getMarkById($item->mark),
                'model' => $item->model,
                'type' => Equipment::getLabelById($item->type),
                'city' => City::getCityById($item->city),
                'price' => $item->price,
                'status' => Rent::getStatusLabel($item->status),
                'phone' => $item->phone,
                'email' => $item->email,
            ]);
        }
        return response()->json($result);
    }
    public function getSales(){
        $result = [];
        foreach (Sale::all() as $item) {
            array_push($result, [
                'id' => $item->id,
                'mark' => Mark::getMarkById($item->mark),
                'model' => $item->model,
                'type' => Equipment::getLabelById($item->type),
                'city' => City::getCityById($item->city),
                'price' => $item->price,
                'status' => Rent::getStatusLabel($item->status),
                'phone' => $item->phone,
                'email' => $item->email,
            ]);
        }
        return response()->json($result);
    }
    public function getServicesA(){
        $result = [];
        foreach (Service::all() as $item) {
            array_push($result, [
                'id' => $item->id,
                'mark' => Mark::getMarkById($item->mark),
                'service' => ServiceType::getLabelById($item->service),
                'type' => Equipment::getLabelById($item->type),
                'price' => $item->price,
                'status' => Rent::getStatusLabel($item->status),
                'phone' => $item->phone,
                'email' => $item->email,
            ]);
        }
        return response()->json($result);
    }

    public function deleteRent(Request $request){
        $data = Rent::findOrFail($request->id);
        if($data === null){
            return response()->json([
                'success' => false,
                'error' => 'Нет указанного ID'
            ]);
        }
        try{
            $data->delete();
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }
    public function deleteSale(Request $request){
        $data = Sale::findOrFail($request->id);
        if($data === null){
            return response()->json([
                'success' => false,
                'error' => 'Нет указанного ID'
            ]);
        }
        try{
            $data->delete();
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }
    public function deleteServiceA (Request $request){
        $data = Service::findOrFail($request->id);
        if($data === null){
            return response()->json([
                'success' => false,
                'error' => 'Нет указанного ID'
            ]);
        }
        try{
            $data->delete();
        }catch (\Exception $ex){
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    public function users(){
        return view('admin.users');
    }
    public function getUsers(){
        $result = [];
        foreach (User::all() as $user){
            array_push($result, [
                'id' => $user->id,
                'email' => $user->email,
                'phone' => $user->phone,
                'role' => $user->role === 'admin' ? 'Администратор' : 'Клиент'
            ]);
        }
        return response()->json($result);
    }
}
