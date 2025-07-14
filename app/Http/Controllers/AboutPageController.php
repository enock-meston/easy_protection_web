<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    //index
    public function index()
    {
        $aboutPage = AboutPage::first();
        return view('livewire.admin.about-page', compact('aboutPage'));
    }
    //update the about page
    public function update(Request $request)
    {
        $aboutPage = AboutPage::first();
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'mission' => 'required|string',
            'vision' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('about_images'), $imageName);
            $validated['image'] = $imageName;
        } else if ($aboutPage) {
            $validated['image'] = $aboutPage->image;
        }

        if ($aboutPage) {
            $aboutPage->update($validated);
        } else {
            AboutPage::create($validated);
        }

        return redirect()->back()->with('success', 'About page updated successfully');
    }
}
