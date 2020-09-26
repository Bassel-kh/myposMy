<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->latest()->paginate(5);

        return view('dashboard.products.index', compact('categories', 'products'));

    } // end of index


    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));

    } // end of create


    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required'
        ];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => 'required|unique:product_translations,name'];
            $rules += [$locale . '.description' => 'required'];

        }//end of  for each

        $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ];

        $request->validate($rules);

        $request_data = $request->all();

        if ($request->image) {

            $img = Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

            $img->stream(); // <-- Key point
            $fileName = $request->image->hashName();
            Storage::disk('public_uploads')->put('products_images'.'/'.$fileName, $img, 'public');

            $request_data['image'] = $request->image->hashName();

        }//end of if

        Product::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');

    }//end of store


    public function show(Product $product)
    {
        //

    } // end of show


    public function edit(Product $product)
    {
        return view('dashboard.product.edit',compact('product'));

    } // end of edit


    public function update(Request $request, Product $product)
    {
        //

    } // end of update


    public function destroy(Product $product)
    {
        //

    } // end of destroy

} // end of controller
