<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class DashboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('dashboard.categories.index', [
            'title' => 'categories',
            'active' => 'categories',
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard.categories.create', [
            'title' => 'categories',
            'active' => 'categories',
            'category' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request){

        $request['slug'] = Str::slug($request->name);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories'
        ]);

        $validatedData['image'] = $request->file('image')->store('category-images');

        Category::create($validatedData);
        return redirect('/dashboard/categories')->with('success', 'A new category has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category){
        return view('dashboard.categories.category_edit', [
            'title' => 'edit',
            'active' => 'edit',
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category){
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        if ($category->image != null) {
            Storage::delete($category->image);
        }
        $validatedData['image'] = $request->file('image')->store('category-images');
        
        Category::where('id', $category->id)->update($validatedData);
        return redirect('/dashboard/categories')->with('success', 'A category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category){

        Category::destroy($category->id);
        return redirect('/dashboard/categories')->with('success', 'A category has been deleted');
    }
}
