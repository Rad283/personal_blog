<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('website.postingan', [
            'kategori' => kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = $request->file('thumbnail')->store('public/thumbnail');
        $final_path = ltrim($path, 'public');

        post::create([
            'judul' => $request->judul,
            'thumbnail' => $final_path,
            'kategori_id' => $request->kategori_id,
            'postingan' => $request->postingan
        ]);

        return to_route('welcome');
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        return view('detail', [
            'website' => DB::table('websites')->first(),
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        $post->delete();
        return to_route('dashboard');
    }
}
