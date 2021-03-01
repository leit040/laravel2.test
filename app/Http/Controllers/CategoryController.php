<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;



class CategoryController extends Controller


{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('pages/category/index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view('pages/category/edit',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=> ['required','min:5','unique:categories,title,id'],
            'slug'=> ['required','min:5','unique:categories,slug,id']
        ]);

        //dd($data);
        $category = Category::create($data);
        return new RedirectResponse('/category/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category =  Category::find($id);
        return view('pages/category/edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'title'=> ['required','min:5','unique:categories,title,'.$id],
            'slug'=> ['required','min:5','unique:categories,slug,'.$id]
        ]);
        $category =  Category::find($id);
        $category->title=$data['title'];
        $category->slug=$data['slug'];
        $category->save();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "Category \"{$data['title']}\" successfully saved",

        ];
        return new RedirectResponse('/category/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $category =  Category::find($id);
        $title=$category->title;
        $category->delete();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "Category \"{$title}\" successfully deleted",

        ];

        return new RedirectResponse('/category/index');
    }
}
