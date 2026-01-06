<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{

        public function index()
        {
            $activeSale = Sale::where('ends_at', '>', Carbon::now())
                ->latest('starts_at')
                ->first();
    
            return view('admin.sales', compact('activeSale'));
        }

        public function active()
{
    $sale = Sale::where('ends_at', '>', now())->first();

    if ($sale) {
        return response()->json(['success' => true, 'sale' => $sale]);
    } else {
        return response()->json(['success' => false, 'message' => 'No active sale found']);
    }
}

    
        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'starts_at' => 'required|date',
                'ends_at' => 'required|date|after:starts_at',
                'discount_percent' => 'required|numeric|min:0|max:100',
            ]);
    
            Sale::truncate();
    
            $sale = Sale::create($validated);
    
            return response()->json([
                'success' => true,
                'message' => 'Sale created successfully!',
                'sale' => $sale
            ]);
        }
    
        public function update(Request $request, $id)
        {
            $sale = Sale::findOrFail($id);
    
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'starts_at' => 'required|date',
                'ends_at' => 'required|date|after:starts_at',
                'discount_percent' => 'required|numeric|min:0|max:100',
            ]);
    
            $sale->update($validated);
    
            return response()->json([
                'success' => true,
                'message' => 'Sale updated successfully!',
                'sale' => $sale
            ]);
        }
    
        public function destroy($id)
        {
            $sale = Sale::find($id);
    
            if (!$sale) {
                return response()->json(['success' => false, 'message' => 'Sale not found']);
            }
    
            $sale->delete();
    
            return response()->json(['success' => true, 'message' => 'Sale ended successfully!']);
        }
    }
    

