<?php

namespace App\Http\Controllers;

use App\Models\website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
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
    public function show(website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(website $website)
    {
        return view('website.website_edit', [
            'website' => $website
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, website $website)
    {




        if ($request->header_image !== false) {
            Storage::delete('public/' . $website->header_image);
            $path = $request->file('header_image')->store('public');
            $final_path = ltrim($path, 'public');
        } else {
            $final_path = $website->header_image;
        }


        $website->update([
            'nama_website' => $request->nama_website,
            'header_image' => $final_path,
            'github_link' => $request->github_link
        ]);

        return to_route('website.edit', 1);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(website $website)
    {
        $website->update(
            [
                "header_image" => false
            ]
            );
        return to_route('dashboard');
  
    }
}
