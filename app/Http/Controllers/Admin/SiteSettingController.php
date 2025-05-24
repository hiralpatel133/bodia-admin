<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        return view('admin.settings.index', compact('settings'));
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
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email',
            'address' => 'nullable|string',
            'site_currency' => 'required|string|max:10'
        ]);

        $settings = SiteSetting::first() ?? new SiteSetting();
        
        if ($request->hasFile('site_logo')) {
            if ($settings->site_logo) {
                Storage::delete('public/' . $settings->site_logo);
            }
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            $settings->site_logo = $logoPath;
        }

        $settings->site_name = $request->site_name;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->site_currency = $request->site_currency;
        $settings->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
