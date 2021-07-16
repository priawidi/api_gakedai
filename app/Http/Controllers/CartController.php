<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Menu;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Response;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Cart::all();
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
            'item_price' => $request->item_price * $request->item_qty,
            'item_photo' => $request->item_photo,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $item_name = ['item_name' => $request->item_name];

        $namaitem = Cart::where('item_name', '=', $request->item_name)->first('item_name');
        $iduser = Cart::where('user_id', '=', $request->user_id)->first('user_id');
        //$namaitem->where('item_name', '=', $request->item_name)->first();
        //return response()->json($namaitem);
        $tabel = Cart::all();
        if ($tabel->isEmpty()) {
            Cart::insert($data);
            return response()->json($data);
        } elseif ($namaitem && $iduser) {
            $keranjang = new Cart;
            $keranjang->where('item_name', '=', $request->item_name)->increment('item_qty', $request->item_qty);
            $keranjang->where('item_name', '=', $request->item_name)->increment('item_price', $request->item_price * $request->item_qty);
            return response()->json('Updated');
        } else {
            Cart::insert($data);
            return response()->json('beda bos');
        }
    }

    public function decrease(Request $request)
    {
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

        $keranjang = new Cart;
        $keranjang->where('item_name', '=', $request->item_name)->decrement('item_qty', 1);
        $keranjang->where('item_name', '=', $request->item_name)->decrement('item_price', $request->item_price);
        return response()->json('Updated');
    }


    public function show($id)
    {
        //$user_id = Cart::find($id)->get();
        if ($id ==  $id) {
            $cart = Cart::select('id', 'user_id', 'item_qty', 'item_name', 'item_price', 'item_photo')->where('user_id', $id)->get();
            $res['message'] = "SUCCESS!";
            $res['menu'] = $cart;
            return response()->json($res);
        }
        return response()->json($id);
    }

    public function showimage($filename)
    {
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

    public function update(Request $request, $id)
    {
        //
        $menu = Cart::find($id);
        $menu->update($request->all());

        return response()->json($menu);

        return "Data Berhasil di Update";

        return "Data Berhasil Masuk";
    }

    public function destroy($id)
    {
        //
        Cart::where('user_id', $id)->delete();

        return response()->json($id . ' ' . 'Deleted');

        return "Data Berhasil di Hapus";
    }
}
