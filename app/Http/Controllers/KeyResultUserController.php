<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeyResultUser;
use App\Models\Keyresult;
use App\Models\OkrTracking;
use App\Models\User;

class KeyResultUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    public function list(){
        $user = User::find(session('id_user'));
        //dd($user);
        $key = OkrTracking::where('id_user',$user->id)
        ->pluck('kode_key');
        //dd($key);

        $key_result = KeyResult::whereIn('kode',$key)->get();
        //dd($key_result);
        return view('content.user.key_result_user_list',compact('key_result'));
    }
    public function show($id)
    {
        $user = User::find(session('id_user'));
        //dd($user);
        $kode_key = Keyresult::find($id);
        $key = KeyResultUser::where([
            'id_user' => $user->id,
            'kode_key' => $kode_key->kode,
        ])
        ->get();

        $key = $key[0];

        return view('content.user.key_result_user_detail',compact('key'));
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
    }
}
