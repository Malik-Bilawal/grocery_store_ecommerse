<?php

namespace App\Http\Controllers\Admin;

use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = HeroSlider::latest()->get();
        return view('admin.slider', compact('sliders'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('[HERO SLIDER] Incoming request', [
                'request' => $request->all(),
                'time' => now()->toDateTimeString(),
            ]);
    
            // VALIDATION
            Log::info('[HERO SLIDER] Running validation...');
            $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'button_text' => 'nullable|string|max:100',
                'button_url' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
                'status' => 'required|boolean',
            ]);
            Log::info('[HERO SLIDER] Validation passed.');
    
            // CREATE HERO SLIDER
            Log::info('[HERO SLIDER] Creating record...');
            $heroSlider = HeroSlider::create([
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'button_url' => $request->button_url,
                'status' => $request->status,
            ]);
            Log::info('[HERO SLIDER] Record created successfully', [
                'hero_slider_id' => $heroSlider->id
            ]);
    
            // HANDLE IMAGE UPLOAD
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $folder = 'uploads/sliders/hero_slider/' . $heroSlider->id; // Fixed folder path
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
    
                // Store file in public disk
                $path = $file->storeAs($folder, $filename, 'public');
    
                if ($path) {
                    $heroSlider->update(['image' => $path]);
                    Log::info('[HERO SLIDER] Image uploaded successfully', [
                        'path' => $path
                    ]);
                } else {
                    Log::warning('[HERO SLIDER] Image upload failed', [
                        'file' => $file->getClientOriginalName()
                    ]);
                }
            }
    
            return redirect()->back()->with('success', 'Hero slider added successfully.');
            
        } catch (ValidationException $e) {
            Log::warning('[HERO SLIDER] Validation failed', [
                'errors' => $e->errors(),
                'request' => $request->all()
            ]);
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('[HERO SLIDER] Error occurred', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }

    }
public function update(Request $request, HeroSlider $heroSlider)
{

    $request->validate([
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'button_text' => 'nullable|string|max:100',
        'button_url' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        'status' => 'required|boolean',
    ]);

    $heroSlider->update([
        'title' => $request->title,
        'description' => $request->description,
        'button_text' => $request->button_text,
        'button_url' => $request->button_url,
        'status' => $request->status,
    ]);

    if ($request->hasFile('image')) {
        if ($heroSlider->image && Storage::disk('public')->exists($heroSlider->image)) {
            Storage::disk('public')->delete($heroSlider->image);
        }

        $file = $request->file('image');
        $folder = 'uploads/sliders/hero_slider' . $heroSlider->id;
        $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $path = $file->storeAs($folder, $filename, 'public');
        $heroSlider->update(['image' => $path]);
    }

    return redirect()->back()->with('success', 'Hero slider updated successfully.');
}

    public function destroy(HeroSlider $heroSlider)
    {
        if ($heroSlider->image && Storage::disk('public')->exists($heroSlider->image)) {
            Storage::disk('public')->delete($heroSlider->image);
        }
        $heroSlider->delete();

        return redirect()->back()->with('success', 'Hero slider deleted successfully.');
    }
}
