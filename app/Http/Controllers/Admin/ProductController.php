<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products')); // devuelve la vista con listados de productos
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();//trae todas las categorias
    	return view('admin.products.create')->with(compact('categories')); // Devuelve el formulario para el registro de un producto
    }

    public function store(Request $request) // Graba los productos en la base de datos
    {
    	//Validar
        $messages = [
            'name.required' => 'Es necesario ingresar un código para el producto.',
            'name.min' => 'El codigo del producto debe tener un al menos 3 caracteres.',
            'description.required' => 'El producto debe tener una descripción.',
            'description.max' => 'La descripción permite un maximo de 200 carateres.', 
            'price.required' => 'El producto debe tener un precio.',
            'price.numeric' => 'Ingrese un precio válido.',
            'price.min' => 'No se admiten valores negativos.'
        ]; 
       
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0',
        ];
        $this->validate($request, $rules, $messages);

        //dd($request->all());
    	$product = new Product();
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id;
    	$product->save(); //graba los datos en la table

    	return redirect('/admin/products');

    }

    public function edit($id)
    {
        $categories = Category::orderBy('name')->get();//trae todas las categorias
    	$product = Product::find($id);
    	return view('admin.products.edit')->with(compact('product', 'categories')); // devuelve el producto a editar
    }

    public function update(Request $request, $id) // modificaa los productos en la base de datos
    {
    	//dd($request->all());
    	$product = Product::find($id);
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id;
    	$product->save(); //graba los datos en la table

    	return redirect('/admin/products');

    }

    public function destroy($id) // borra los productos en la base de datos
    {
        //dd($request->all());
        $product = Product::find($id);
        $product->delete(); //graba los datos en la table

        return back();

    }
}
