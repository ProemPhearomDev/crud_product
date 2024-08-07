<?php

namespace App\Http\Controllers\app;

use App\Models\app\ProCate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProCate::all();
        return view(
            "categories.index",
            [
                'categories' => $categories
            ]
        );
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->all();
        //create a new product
        ProCate::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('categories.index')->with('success', 'Create sucessfully!');
    }



    // public function show(string $id)
    // {
    //     //
    //     $add = Product::find($id);
    //     return view('product.add', ['add' => $add]);
    // }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {
        $request->all();
        $category = ProCate::find($id);
        $category->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->back()->with('success', 'Updated sucessfully!');
    }

    // for soft delete
    public function destroy(string $id)
    {
        $category = ProCate::find($id);
        // $category->update([
        //     'status' => '1'
        // ]);
        $category->delete();
        return redirect()->back()->with('success', 'Deleted sucessfully!');
    }
}
