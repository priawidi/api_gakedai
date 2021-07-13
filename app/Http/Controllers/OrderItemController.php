<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Response;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = OrderItem::all();
        if (count($data) > 0) {
            $res['message'] = "SUCCESS!";
            $res['data'] = $data;

            return response($res);
        } else {
            $res['message'] = "EMPTY!";
            return response($res);
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'user_id' => 'required',
            'user_name' => 'required',
            'item_qty' => 'required',
            'item_name' => 'required',
            'item_price' => 'required',
            'item_photo' => 'required',
        ]);        
        $data = [
            'user_id' => $request->user_id,
            'user_name' => $request->user_name,
            'item_qty' => $request->item_qty,
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
            'item_photo' => $request->item_photo,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        
        $item_name = ['item_name' => $request->item_name];
    
        $namaitem = OrderItem::where('item_name', '=', $request->item_name)->first('item_name');
        $iduser = OrderItem::where('user_id', '=', $request->user_id)->first('user_id');
        //$namaitem->where('item_name', '=', $request->item_name)->first();
        //return response()->json($namaitem);
        $tabel = OrderItem::all();
        if($tabel->isEmpty()){
            OrderItem::insert($data);
            return response()->json($data);
        }elseif($namaitem && $iduser){
            $keranjang = new OrderItem;
            $keranjang->where('item_name', '=', $request->item_name)->increment('item_qty', $request ->item_qty);
            $keranjang->where('item_name', '=', $request->item_name)->increment('item_price', $request ->item_price);
            return response()->json('Updated');
        }else{
            OrderItem::insert($data);
            return response()->json('beda bos');
        }      
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if($id ==  $id){
            $hist= OrderHistory::select('id','user_id','item_qty', 'item_name', 'item_price', 'item_photo')->where('user_id', $id)->get();
            $res['message'] = "SUCCESS!";
            $res['menu'] = $hist;
            return response()->json($res);
        }
        return response()->json($id);
    }

    public function showimage($filename){
        $path = public_path() . '/image/menu/' . $filename;
        return Response::download($path);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $menu = OrderItem::find($id);
        $menu->update($request->all());

        return response()->json($menu);

        return "Data Berhasil di Update";

        return "Data Berhasil Masuk";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $menu = OrderHistory::find($id);
        $menu->delete();

        return response()->json("Data Berhasil di Hapus");
    }
}
