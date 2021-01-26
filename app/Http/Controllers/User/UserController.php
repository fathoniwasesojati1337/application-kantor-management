<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Acara;
use App\Models\Proyek;
use App\Models\Blog;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $blog = Blog::all();
        $jumlah = Blog::all()->count();
        return view('user.home', ['blog' => $blog, 'jumlah' => $jumlah]);
    }

    public  function acara(){

        $acara = Acara::where('user_id', auth()->user()->id)->paginate(10);
        return view('user.acara', ['acara' => $acara]);

    }
    public function list(){

        return view('user.list');

    }

    public function getPengumpulan(){

        return view('user.pengumpulan');
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

    public function logoutUser(){

        Auth::logout();
        return redirect('/');
    }
    public function getProyek(){
        $proyek = Proyek::where('user_id', auth()->user()->id)->get();
        return response()->json(['monthly' => $proyek], 200);
    }

}
