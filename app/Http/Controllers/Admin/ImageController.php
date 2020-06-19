<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Product;
Use App\ProductImage;
Use File;

class ImageController extends Controller
{
    public function index($id)
    {
    	$product = Product::find($id);
    	$images = $product->images()->orderby('featured', 'desc')->get();
    	return view('admin.products.images.index')->with(compact('product', 'images'));
    }

    public function store(Request $request, $id)
    {
    	//Guardar la imagen en una carpeta del proyecto
    	$file = $request->file('photo');
    	$path = public_path() . '/images/products';
    	$fileName = uniqid() . $file->getClientOriginalName();
    	$moved = $file->move($path, $fileName);


    	// crer un registro en la tabla product_image
    	if ($moved) {
	    	$productImage = new ProductImage();
	    	$productImage->image = $fileName;
	    	//$productImage->featured = false;
	    	$productImage->product_id = $id;
	    	$productImage->save(); // Inserta el registro en la tabla
    	}
    	return back();



    }

    public function destroy(Request $request, $id)
    {
    	// elimina la imagen fisicamente de la carpeta
    	$productImage = ProductImage::find($request->image_id);
    	if (substr($productImage->image, 0, 4) === "http") {
    		$deleted = true;
    	}else {
    		$fullPath = public_path() .'/images/products/'. $productImage->image;
    		$deleted = File::delete($fullPath);
    	}

    	//elimina el registro de la imagen de la base de datos
    	if ($deleted) {
    		$productImage->delete();
    	}

    	return back();
    }

    public function select($id, $image)
    {
        ProductImage::where('product_id', $id)->update([
            'featured' => false
        ]);

        $productImage = ProductImage::find($image);
        $productImage->featured = true;
        $productImage->save();

        return back();
    } 
}
