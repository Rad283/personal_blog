<?php

namespace App\Http\Controllers;

use App\Models\about;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(about $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(about $about)
    {
        return view('website.about_edit', [
            'about' => about::all()->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, about $about)
    {
        if ($request->photo_profile !== null) {
            Storage::delete('public/' . $about->photo_profile);
            $path = $request->file('photo_profile')->store('public');
            $final_path = ltrim($path, 'public');
        } else {
            $final_path = $about->photo_profile;
        }


        $about->update([
            'nama' => $request->nama,
            'photo_profile' => $final_path,
            'tentang' => $request->tentang
        ]);

        return to_route('about.edit', 1);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(about $about)
    {
        //
    }
}
