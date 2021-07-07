<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Resources\MenuResource;

class MenuController extends Controller
{
    //
    public function index(){   
        $menu = Menu::all();
        if(count($menu)>0){
            $res['message'] = "SUCCESS!";
            $res['menu'] = $menu;

            return response($res);
        }else{
            $res['message'] = "EMPTY!";
            return response($res);
        }
        return MenuResource::collection(Menu::all());
    }

    public function create(request $request){
        $menu = new Menu;
        $menu->name = $request->name;
        $menu->code = $request->code;
        $menu->photo = $request->photo;
        $menu->price = $request->price;
        $menu->type = $request->type;
        $menu->detail = $request->detail;
        $menu->status = $request->status;
        $menu->save();

        return response()->json(["menu" => $menu],200);;
    }

    public function store(Request $request)
    {
        //
        // $request->validate([
        //     'name'=>'required',
        //     'code'=>'required',
        //     'price'=>'required',
        //     'type'=>'required',
        //     'photo'=>'required',
        //     'detail'=>'required',
        //     'status'=>'required',

    // ]);
    // return Menu::create($request->all());

        $input =$request->all();
        $menu = Menu::create($input);
        return new MenuResource($menu);
        
       
    }

    public function update(request $request, $id){
        // $menu = $request->name;
        // $menu = $request->code;
        // $menu = $request->photo;
        // $menu = $request->price;
        // $menu = $request->type;
        // $menu = $request->detail;
        // $menu = $request->status;

        // $menu = Menu::find($id);
        // $menu->name = $name;
        // $menu->code = $code;
        // $menu->photo = $photo;
        // $menu->price = $price;
        // $menu->type = $type;
        // $menu->detail = $detail;
        // $menu->status = $status;
        // $menu->save();

        $menu = Menu::find($id);
        $menu->update($request->all());

        return new MenuResource($menu);

        return "Data Berhasil di Update";

        return "Data Berhasil Masuk";
    }

    public function destroy($id){
        $menu = Menu::find($id);
        $menu->delete();

        return response()->json(null);

        return "Data Berhasil di Hapus";
    }
}
