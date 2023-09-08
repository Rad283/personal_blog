<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LandingPage extends Controller
{

    public function welcome()
    {
        return view('welcome', [
            'website' => DB::table('websites')->first(),
            'kategori' => DB::table('kategoris')->get(),
            'post' => post::with('kategori')->latest()->paginate(6)
        ]);
    }

    public function about()
    {
        return view('about', [
            'website' => DB::table('websites')->first(),
            'kategori' => DB::table('kategoris')->get(),
            'about' => DB::table('abouts')->first()
        ]);
    }

    public function kategori($id)
    {

       
            $post = post::with('kategori')->where('kategori_id','=',$id)->latest()->paginate(6);
         
     
        $namakategori= DB::table('kategoris')->where('id','=',$id)->first();
        return view('kategori', [
            'website' => DB::table('websites')->first(),
            'kategori' => DB::table('kategoris')->get(),
            'namakategori'=>$namakategori,
            'post' => $post,
           

        ]);
    }

public function search(Request $request){
   
    $hasil = post::with('kategori')->where(DB::raw('LEFT(postingan,150)'),'like','%'.$request->cari.'%')->latest()->paginate();

    return view('search',[
        'post'=>$hasil,
        'website' => DB::table('websites')->first(),
        'kategori' => DB::table('kategoris')->get(),
        'search' => $request->cari
    ]);
}

}