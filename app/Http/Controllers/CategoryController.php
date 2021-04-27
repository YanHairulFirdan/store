<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $messages = [
        'name.required' => 'nama kategori tidak boleh kosong',
        'name.min' => 'jumlah karakter tidak boleh kurang dari 5 karakter'
    ];

    protected $rules = [
        'name' => 'required|min:5'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return response()->json(['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatioresult = $this->validateData($request->all());
        if ($validatioresult) {
            return response()->json(['messages' => $validatioresult, 'class' => 'danger']);
        }

        $category = new Category();
        $saveResult = $this->saveCategory($category, $request);
        $message = ($saveResult) ? 'Category berhasil ditambah' : 'Category gagal ditambah';
        $class = ($saveResult) ? 'success' : 'danger';
        return response()->json(['message' => $message, 'class' => $class]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return response()->json(['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validatioresult = $this->validateData($request->all());
        if ($validatioresult) {
            return response()->json(['message' => $validatioresult, 'class' => 'danger']);
        }

        $saveResult = $this->saveCategory($category, $request);

        $message = ($saveResult) ? 'Categopry berhasil diperbaharui' : 'Category gagal diperbaharui';
        $class = ($saveResult) ? 'success' : 'danger';
        return response()->json(['message' => $message, 'class' => $class]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $result = $category->delete();
        $message  = ($result) ? 'Category berhasil dihapus' : "Category gagal dihapus";
        $class  = ($result) ? 'success' : "danger";
        return response()->json(['message' => $message, 'class' => $class]);
    }
    protected function validateData($data)
    {
        $validator = Validator::make($data, $this->rules, $this->messages);

        return ($validator->fails()) ? $validator->errors() : null;
    }

    protected function saveCategory(Category $category, Request $request)
    {
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->parent_id;

        return $category->save();
    }
}
