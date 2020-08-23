<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cat;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Session;


class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Cat::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Cat();
        $category->title = $request->input('title');
        $category->slug = $request->input('slug');     // the input slug must be made before validation!!!
        $category->description = $request->input('description');
        $category->keywords = $request->input('keywords');
        $category->save();
        Session::flash('create_category', 'Category created successfully');
        return redirect('/admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Cat::findOrFail($id);
        return view('admin.categories.edit', compact(['category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Cat::findOrFail($id);
        $category->title = $request->input('title');
        $category->slug = $request->input('slug');     // the input slug must be made before validation!!!
        $category->description = $request->input('description');
        $category->keywords = $request->input('keywords');
        $category->save();

        Session::flash('update_category', 'Category updated successfully');
        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //fist check the posts of the category if was null then delete that
        if (is_null(Cat::findOrFail($id)->posts->first())) {
            $category = Cat::findOrFail($id);
            $category->delete();
            Session::flash('delete_category', 'Category deleted successfully');
            return redirect('/admin/categories');
        }

        Session::flash('delete_category', 'failed to delete the category!!!
        please change the posts of this category to another one then try to delete it again');
        return redirect('/admin/categories');
    }
}
