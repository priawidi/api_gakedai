<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoogleUser;
use App\Http\Resources\GoogleUserResource;

class GoogleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $google = GoogleUser::all();
        if(count($google)>0){
            $res['message'] = "SUCCESS!";
            $res['user'] = $google;
            return response($res);
        }else{
            $res['message'] = "EMPTY!";
            return response($res);
        }
        return GoogleUserResource::collection(GoogleUser::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $google = new GoogleUser;
        $google->email = $request->email;
        $google->email_verified = $request->email_verified;
        $google->picture = $request->picture;
        $google->given_name = $request->given_name;
        $google->family_name = $request->family_name;
        $google->locale = $request->locale;
        $google->save();

        return response()->json(["user" => $google],200);;
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
        
        $input =$request->all();
        $google = GoogleUser::create($input);
        return new GoogleUserResource($google);
        
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
        $google = GoogleUser::find($id);
        $google->update($request->all());

        return new GoogleUserResource($google);
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
        $google = GoogleUser::find($id);
        $google->delete();

        return response()->json(null);
    }
}
