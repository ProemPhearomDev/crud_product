<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\app\ProCate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\app\Product;
use App\Models\app\ProDetails;
use PhpParser\Node\Stmt\Return_;

class ProductController extends Controller
{
    public function index()
    {

        // $products = DB::select('SELECT p.id, p.name, p.photo, c.name AS cate_id,  p.price, (SUM(pd.add) - SUM(pd.sale)) AS qty FROM products p LEFT JOIN pro_cates c ON p.cate_id = c.id LEFT JOIN pro_details pd ON p.id = pd.pro_id GROUP BY p.id, p.name, p.photo, c.name, p.price');
       
        $products = ProCate::all();
        $cate = ProCate::all();
        
        return view(
            "product.index",
            [
                'products' => $products,
                // 'product' => $product,
                'cate' => $cate
            ]
        );
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //upload the image
        $imgPath = null;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imgPath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/product'), $imgPath);
        }

        //create a new product
        Product::create([
            'name' => $request->name,
            'photo' => $imgPath,
            'cate_id' => $request->cate_id,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Create sucessfully!');
    }

    // for add qty
    public function add(string $id)
    {
        $add = DB::select('SELECT p.id, p.name, p.photo, (SUM(pd.add) - SUM(pd.sale)) AS qty FROM products p LEFT JOIN pro_details pd ON p.id = pd.pro_id WHERE p.id = ? GROUP BY p.id, p.name, p.photo', [$id]);
        return view('product.add', ['add' => $add]);
    }

    public function addto(Request $request, string $id)
    {
        ProDetails::create([
            'pro_id' => $id,
            'add' => $request->add,
            'add_price' => $request->price
        ]);
        return redirect()->route('products.index');
    }


    public function show(string $id)
    {
        //
        $add = Product::find($id);
        return view('product.add', ['add' => $add]);
    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {
        $request->all();
        $product = Product::find($id);
         //update the image
         $old_img = $request->old_image;
         $imgPath = null;
         if ($request->hasFile('photo')) {
            @unlink($old_img);
             $image = $request->file('photo');
             $imgPath = time() . '.' . $image->getClientOriginalExtension();
             $image->move(public_path('uploads/product'), $imgPath);
         }
        $product->update([
            'name' => $request->name,
            'photo' => $imgPath,
            'cate_id' => $request->cate_id,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Updated sucessfully!');
    }

    // for soft delete
    public function destroy(string $id)
    {
        $product = Product::find($id);
        // $product->update([
        //     'status' => '1'
        // ]);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Deleted sucessfully!');
    }
}
