<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderHistory;
use Illuminate\Support\Facades\Response;

class OrderHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = OrderHistory::all();
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
            'meja' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'total_price' => 'required',
            'unique_code' => 'required',
            'order_date' => 'required',
            'order_time' => 'required',
        ]);        
        $data = [
            'meja' => $request->meja,
            'user_id' => $request->user_id,
            'user_name' => $request->user_name,
            'total_price' => $request->total_price,
            'unique_code' => $request->unique_code,
            'order_date' => date("Y-m-d"),
            'order_time' => date("Y-m-d H:i:s")
        ];
    
        OrderHistory::insert($data);
        return response()->json($data);
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
            $cart= OrderHistory::select('id','user_id','item_qty', 'item_name', 'item_price', 'item_photo')->where('user_id', $id)->get();
            $res['message'] = "SUCCESS!";
            $res['menu'] = $cart;
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
        $menu = OrderHistory::find($id);
        $menu->update($request->all());

        return "Data Berhasil di Update";
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
