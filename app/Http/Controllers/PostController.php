<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = \App\Models\Post::paginate(3);
        return view('pages/post/index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {

        $post = new \App\Models\Post();
        $categories =  \App\Models\Category::all();
        $tags = \App\Models\Tag::all();
        $users = User::all();
        return view('pages/post/edit',compact('post','categories','tags','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

    $data = $request->validate([
            'title'=> ['required','min:5','unique:categories,title'],
            'body'=>['required','min:45'],
            'category_id'=>['required','exists:categories,id'],
            'tags_id'=>['required','exists:tags,id'],
            'user_id'=>['required','exists:users,id']


        ]);
   // dd($data);

        $post=Post::create($data);
        $post->tags()->attach($data['tags_id']);
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "Post \"{$data['title']}\" successfully saved",

        ];
        return new RedirectResponse('/post/index');
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
        $post =  \App\Models\Post::find($id);
        $tags = \App\Models\Tag::all();
        $users = User::all();
        $categories = \App\Models\Category::all();
        return view('pages/post/edit',compact('post','categories','tags','users'));
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
            'title'=> ['required','min:5','unique:categories,title'],
            'body'=>['required','min:45'],
            'category_id'=>['required','exists:categories,id'],
            'tags_id'=>['required','exists:tags,id'],
            'user_id'=>['required','exists:users,id']


        ]);
        $post =  \App\Models\Post::find($id);
        $post->title=$data['title'];
        $post->body=$data['body'];
        $post->category_id=$data['category_id'];
        $post->user_id=$data['user_id'];
        $post->save();
        $post->tags()->sync($data['tags_id']);
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "Post \"{$data['title']}\" successfully saved",

        ];
        return new RedirectResponse('/post/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =  \App\Models\Post::find($id);
        $title=$post->title;
        $post->delete();
        $_SESSION['message'] = [
            'status' => 'success',
            'message' => "Post \"{$title}\" successfully deleted",

        ];

        return new RedirectResponse('/post/index');
    }

    public function posts_tag($id){
        $posts = Tag::find($id)->posts()->paginate(3);
        return view('pages/post/index',compact('posts'));
    }


    public function posts_category($id){
        $posts=\App\Models\Post::where("category_id",$id)->paginate(3);
        return view('pages/post/index',compact('posts'));
    }

    public function post_user($id){
        $posts=\App\Models\Post::where("user_id",$id)->paginate(3);
        return view('pages/post/index',compact('posts',));
    }

    public function postUserCategoryView(User $user,Category $category){

        $pages = User::find($user->id)->posts()->where('category_id',$category->id)->paginate(3);
        return view('pages/post/index',compact('pages'));
    }

    public function search(){
        $users=User::withCount('posts')->get();
        $categories=Category::withCount('posts')->get();
        $tags=Tag::withCount('posts')->get();

        return view('pages.post.search',compact('users','categories','tags'));

    }


    public function searchResult(User $user,Category $category,$tags)
    {

        $posts = Post::where('category_id', $category->id)->where('user_id', $user->id)->whereHas('tags', function (\Illuminate\Database\Eloquent\Builder $query) use ($tags) {
            $query->whereIN('tags.id', explode("#",$tags));

        })->paginate(3);


        return view("pages/post/index", compact('posts'));
    }
}
