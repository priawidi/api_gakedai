<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Resources\MenuResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Google_Client;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        if (count($menu) > 0) {
            $res['message'] = "SUCCESS!";
            $res['menu'] = $menu;

            return response($res);
        } else {
            $res['message'] = "EMPTY!";
            return response($res);
        }
        return MenuResource::collection(Menu::all());
    }

   
    public function create(request $request)
    {

        $menu = new Menu;
        $menu->name = $request->name;
        $menu->code = $request->code;
        $menu->photo = $request->photo;
        $menu->price = $request->price;
        $menu->type = $request->type;
        $menu->detail = $request->detail;
        $menu->status = $request->status;
        $menu->save();

        return response()->json(["menu" => $menu], 200);
    }
    public function show($filename)
    {
        $path = public_path() . '/image/menu/' . $filename;
        return Response::download($path);
    }

    public function filter($type){
        $data = Menu::all();
        
        if('Minuman' ==  $type){
            $minum= Menu::select('id','name','photo', 'price', 'type', 'detail', 'status')->where('type', 'Minuman')->get();
            $res['message'] = "SUCCESS!";
            $res['menu'] = $minum;
            return Response()->json($res);
        }else {
            $makan= Menu::select('id','name','photo', 'price', 'type', 'detail', 'status')->where('type', 'Makanan')->get();
            $res['message'] = "SUCCESS!";
            $res['menu'] = $makan;
            return Response()->json($res);
        }
        

       
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'price' => 'required',
            'type' => 'required',
            'detail' => 'required',
            'status' => 'required',
        ]);

        $file = $request->file('photo');
        $format = $file->getClientOriginalExtension();
        $filename = $request->name . '.' . $format;
        $file->move('image/menu', $filename);

        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price,
            'type' => $request->type,
            'detail' => $request->detail,
            'status' => $request->status,
            'photo' => $filename,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        Menu::insert($data);
        return response()->json($data);
    }


    public function update(request $request, $id)
    {

        $menu = Menu::find($id);
        $menu->update($request->all());

        return new MenuResource($menu);

        return "Data Berhasil di Update";

        return "Data Berhasil Masuk";
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();

        return response()->json(null);

        return "Data Berhasil di Hapus";
    }


    public function tokensignin($idtoken)
    {
        require_once 'vendor/autoload.php';
        $token = $idtoken;
        return response()->json(["token" => $token], 200);

        $client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
            $userid = $payload['sub'];
            // If request specified a G Suite domain:
            //$domain = $payload['hd'];
        } else {
            // Invalid ID token
        }
    }
}
