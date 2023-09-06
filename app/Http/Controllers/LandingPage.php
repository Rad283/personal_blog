<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPage extends Controller
{

    public function welcome()
    {
        return view('welcome', [
            'website' => DB::table('websites')->first(),
            'kategori' => DB::table('kategoris')->get(),
            'post' => DB::table('posts')
                ->join('kategoris', 'posts.kategori_id', '=', 'kategoris.id')
                ->select('posts.*', 'kategoris.nama')->latest()->get()
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

        if (post::where('kategori_id', $id)->exists()) {
            $post = DB::table('posts')
                ->join('kategoris', 'posts.kategori_id', '=', 'kategoris.id')
                ->select('posts.*', 'kategoris.nama')
                ->where('kategori_id', '=', $id)
                ->latest()->get();
            $bol = TRUE;
        } else {
            $post = [];
            $bol = FALSE;
        }
        $namakategori= DB::table('kategoris')->where('id','=',$id)->first();
        return view('kategori', [
            'website' => DB::table('websites')->first(),
            'kategori' => DB::table('kategoris')->get(),
            'namakategori'=>$namakategori,
            'post' => $post,
            'bol' => $bol

        ]);
    }
}
