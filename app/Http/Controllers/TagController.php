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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $tags = tag::latest()->paginate(10);
        return view('pages.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $tag = new tag();
        $method='POST';
        return view('pages.tag.edit',compact('tag','method'));
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

        //dd($data);
        $tag = tag::create($data);
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "tag \"{$data['title']}\" successfully saved",

        ];
        return new RedirectResponse('/tag/');
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
        $tag =  tag::find($id);
        $method='PUT';
        return view('pages/tag/edit',compact('tag','method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, tag $tag)
    {
        $data = $request->validate([
            'title'=> ['required','min:5','unique:tags,title,'.$tag->id],
            'slug'=> ['required','min:5','unique:tags,slug,'.$tag->id]
        ]);
        $tag =  tag::find($tag->id);
        $tag->title=$data['title'];
        $tag->slug=$data['slug'];
        $tag->save();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "tag \"{$data['title']}\" successfully saved",

        ];
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $tag =  tag::find($id);
        $title=$tag->title;
        $tag->delete();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "tag \"{$title}\" successfully deleted",

        ];

        return new RedirectResponse('/tag');
    }
}
