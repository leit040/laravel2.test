<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('pages/tag/index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = new Tag();
        return view('pages/tag/edit',compact('tag'));
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
            'title'=> ['required','min:5','unique:tags,title,id'],
            'slug'=> ['required','min:5','unique:tags,slug,id']
        ]);
        Tag::create($data);
         $_SESSION['message'] = [
            'status' => 'success',
            'message' => "Tag \"{$data['title']}\" successfully saved",

        ];
        return new RedirectResponse('/tag/index');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag =  Tag::find($id);
        return view('pages/tag/edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title'=> ['required','min:5','unique:tags,title,'.$id],
            'slug'=> ['required','min:5','unique:tags,slug,'.$id]
        ]);
        $tag =  Tag::find($id);
        $tag->title=$data['title'];
        $tag->slug=$data['slug'];
        $tag->save();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "Tag \"{$data['title']}\" successfully saved",

        ];
        return new RedirectResponse('/tag/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag =  Tag::find($id);
        $title=$tag->title;
        $tag->delete();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "Tag \"{$title}\" successfully deleted",

        ];

        return new RedirectResponse('/tag/index');

    }
}
