<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
   public function index()
    {
    	$categories = Category::orderby('id')->paginate(10);
    	return view('admin.categories.index')->with(compact('categories')); // devuelve la vista con listados de productos
    }

    public function create()
    {
    	return view('admin.categories.create'); // Devuelve el formulario para el registro de un categorías
    }

    public function store(Request $request) // Graba los productos en la base de datos
    {
    	//Validar

        $this->validate($request, Category::$rules, Category::$messages);

        
        Category::create($request->all()); // mass assigment

       	return redirect('/admin/categories');

    }

    public function edit(Category $category)
    {
    	return view('admin.categories.edit')->with(compact('category')); // devuelve el producto a editar
    }

    public function update(Request $request, Category $category) // modificaa los productos en la base de datos
    {

        $this->validate($request, Category::$rules, Category::$messages);

    	//dd($request->all());
    	$category->update($request->all()); //graba los datos en la table

    	return redirect('/admin/categories');

    }

    public function destroy(Category $category) // borra los productos en la base de datos
    {
        //dd($request->all());
        $category->delete();
       
        return back();

    }
}
