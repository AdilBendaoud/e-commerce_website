<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function indexAdmin()
    {
        $products = Product::with('images')->get();
        $categories = Categorie::all();
        return view('admin.products',compact('products','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // Store the product data in the database
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->categorie_id= $request->category;
        $product->list_price = $request->list_price;
        $product->sale_price = $request->sale_price;
        $product->quantity = $request->quantity;
        $product->save();

        // Upload and store the cover image
        $currentDateTime = Carbon::now();
        $dateTimeFormatted = $currentDateTime->format('d-m-Y');
    
        $coverImage = $request->file('cover_image');
        $coverImageName = $coverImage->getClientOriginalName();
        $cleanedImageName = str_replace(' ', '-', $coverImageName);
        $coverImage->storeAs('public/products/' . $product->id, $dateTimeFormatted . '_' . $cleanedImageName);
        
        $image1 = new ProductImage();
        $image1->image_path = 'storage/products/' . $product->id . '/' . $dateTimeFormatted . '_' . $cleanedImageName;
        $image1->product_id = $product->id;
        $image1->cover = true;
        $image1->save();

        // Upload and store additional images (if any)
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $additionalImage) {
                $additionalImageName = $additionalImage->getClientOriginalName();
                $additionalImage->storeAs('public/products/' . $product->id, $dateTimeFormatted . '_' . $additionalImageName);
                
                $image2 = new ProductImage();
                $image2->image_path = 'storage/products/'. $product->id . '/' . $dateTimeFormatted . '_' . $additionalImageName;
                $image2->product_id = $product->id;
                $image2->cover = false;
                $image2->save();
            }
        }
        
        return redirect()->back()->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->categorie_id= $request->category;
        $product->list_price = $request->list_price;
        $product->sale_price = $request->sale_price;
        $product->quantity = $request->quantity;
        $product->save();

        $currentDateTime = Carbon::now();
        $dateTimeFormatted = $currentDateTime->format('d-m-Y');
        
        if($request->hasFile('cover_image')){
            $oldCoverImage = ProductImage::where(['product_id'=>$product->id,'cover'=>true])->first();
            $cleanedUrl = preg_replace('/^storage\//', '', $oldCoverImage->image_path);
            
            if (Storage::exists('/public'.$request->image_url)){
                Storage::delete('/public/' . $cleanedUrl);
                $oldCoverImage->delete();
            }else{
                return redirect()->back()->with('error','image not found');
            }
        
            $coverImage = $request->file('cover_image');
            $coverImageName = $coverImage->getClientOriginalName();
            $cleanedImageName = str_replace(' ', '-', $coverImageName);
            $coverImage->storeAs('public/products/' . $product->id, $dateTimeFormatted . '_' . $cleanedImageName);
            
            $image1 = new ProductImage();
            $image1->image_path = 'storage/products/' . $product->id . '/' . $dateTimeFormatted . '_' . $cleanedImageName;
            $image1->product_id = $product->id;
            $image1->cover = true;
            $image1->save();
        }

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $additionalImage) {
                $additionalImageName = $additionalImage->getClientOriginalName();
                $additionalImage->storeAs('public/products/' . $product->id, $dateTimeFormatted . '_' . $additionalImageName);
                
                $image2 = new ProductImage();
                $image2->image_path = 'storage/products/'. $product->id . '/' . $dateTimeFormatted . '_' . $additionalImageName;
                $image2->product_id = $product->id;
                $image2->cover = false;
                $image2->save();
            }
        }
        
        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    public function showProductInfo(Product $product){
        return response()->json(['product'=>$product]);
    }

    public function destroyImage(Request $request){
        if (Storage::exists('/public'.$request->image_url)) {
            $imageToDelete = ProductImage::where('image_path','storage'.$request->image_url)->first();
            $imageToDelete->delete();
            Storage::delete('/public' . $request->image_url);
            return response()->json(['message' => 'Image deleted successfully']);
        } else {
            return response()->json(['message' => 'Image not found']);
        }
    }
}
