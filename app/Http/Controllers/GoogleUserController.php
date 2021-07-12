<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoogleUser;
use App\Http\Resources\GoogleUserResource;
use Illuminate\Support\Facades\Validator;

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
        if (count($google) > 0) {
            $res['message'] = "SUCCESS!";
            $res['user'] = $google;
            return response($res);
        } else {
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = GoogleUser::updateOrCreate([
        // 'user_ud' => $user_id,

        // ]);
        $google = GoogleUser::firstOrCreate([

            'user_id' =>  $request->user_id,
            'email' =>  $request->email,
            'name' =>  $request->name,
            'picture' =>  $request->picture,
            'given_name' =>  $request->given_name,
            'family_name' =>  $request->family_name,
        ]);
        //$google = GoogleUser::create($input);
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
