<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Detailt;
use Illuminate\Http\Request;
use App\Models\Acara;
use App\Models\Proyek;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use Intervention\Image\Facades\Image;

class Admin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $user = User::all();
       $acara = Acara::where('user_id', '=', auth()->user()->id)->get();
       return view('admin.home', ['user' => $user, 'acara' => $acara]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        

        \DB::table('proyek')->insert([
            'user_id' => $request->user_id, //This Code coming from ajax request
            'name' => $request->name, //This Code coming from ajax request
            'startdate' => $request->startdate, //This Code coming from ajax request
            'enddate' => $request->enddate, //This Code coming from ajax request
            'color' => $request->color, //This Code coming from ajax request

        ]);

        $user = \DB::table('users')
        ->join('proyek', 'users.id','=', 'proyek.user_id')
        ->join('detailt', 'users.id','=', 'detailt.user_id')
        ->where('proyek.user_id','=', $request->user_id)
        ->select('users.name', 'pegawai')->first();
         return response()->json(['name'=> $request->name, 'startdate' => $request->startdate, 'enddate' => $request->enddate, 'user_name' => $user->name, 'pegawai' => $user->pegawai]);

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

        \DB::table('acara')->insert([
            'user_id' => auth()->user()->id, //This Code coming from ajax request
            'nama' => $request->nama, //This Code coming from ajax request
            'date' => $request->date, //This Code coming from ajax request
            'status' => 'pending', //This Code coming from ajax request

        ]);

        return response()->json(['nama'=> $request->nama, 'status' => 'pending', 'date' => $request->date]);
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
        
        $user = User::find($id);
        $detail = Detailt::where('user_id', $id)->first();
        $user->update($request->all());
        $detail->update([
            'nip' => $request->nip,
            'address' => $request->address,
            'provinsi' => $request->provinsi,

        ]);
        
        return redirect('/dashboard')->with('status', 'data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete($user);
        return redirect('/dashboard')->with('status', 'data berhasil dihapus');
    }

    public function getAcara(){

        $acara = Acara::where('user_id', auth()->user()->id)
        ->select('id', 'nama', 'date')->get();

        return response()->json(['monthly' => $acara], 200);


    }

    public function getProyek(){

        $proyek = Proyek::all();
        return response()->json(['monthly' => $proyek], 200);

    }

    public function getEvent(){

        $proyek = \DB::table('users')
        ->join('proyek', 'users.id','=', 'proyek.user_id')
        ->join('detailt', 'users.id','=', 'detailt.user_id')
        ->select('users.name', 'detailt.pegawai', 'proyek.enddate')->get();
        $user  = User::all();
        return view('admin.proyek',['proyek' => $proyek, 'user' =>$user]);

    }

    public function inputBlogPost(Request $request){

        $rules = [
            'judul' => 'required',
            'pembukaan' => 'required',
            'content' => 'required',
        ];

        $valid = Validator::make($request->all(), $rules);

        if($valid->fails()){

            return redirect('/input/blog')->with('gagal', $valid->errors());

        }else{
            $namafoto = $request->foto->getClientOriginalName();
            $path = public_path('image/');
            $request->foto->move($path, $namafoto);

            Blog::create([
                'judul' => $request->judul,
                'content' => $request->content,
                'foto' => $namafoto,
                'pembukaan' => $request->pembukaan,
            ]);

            return redirect('/input/blog')->with('status', 'blog berhasil ditambahkan');

        }


    }

}
