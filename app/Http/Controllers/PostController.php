<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\CommentsController;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Showing posts
    public function index(Request $request)
    {
        $categories = Category::all();

         // Posts by category
        if(isset(request()->cat)) {

            $cat = Category::where('name', request()->cat)->first();
            $allPosts = Post::where('category_id', $cat->id)->get();

        // Posts by search result
        }elseIf($request->has('query')){

            $search_text = $request['query'];


            $allPosts = Post::where('description', 'LIKE', '%'.$search_text.'%')->get();

        // All posts
        }else{

            $allPosts = Post::all();

        }

        return view('welcome', compact('allPosts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Showing the form for creating a new post
    public function create()
    {
        $categories = Category::all();
        return view('createBlogForm', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Creating of new post
    public function store(Request $request)
    {
          $request->validate([
            'description' => 'string|max:255|required',
            'body' =>  'required',
            'image1' => 'mimes:jpg,jpeg,png',
            'image2' => 'mimes:jpg,jpeg,png',
            'image3' => 'mimes:jpg,jpeg,png',
            'category' => 'required'
          ]);

          if ($request->hasFile('image1')) {

               $image1 = $request->file('image1');
               $image1_name = time().'1.'.$image1->extension();
               $image1->move(public_path('/images/post_images'),$image1_name);

          }
          if ($request->hasFile('image2')) {

            $image2 = $request->file('image2');
            $image2_name = time().'2.'.$image2->extension();
            $image2->move(public_path('/images/post_images'),$image2_name);

          }
          if ($request->hasFile('image3')) {

            $image3 = $request->file('image3');
            $image3_name = time().'3.'.$image3->extension();
            $image3->move(public_path('/images/post_images'),$image3_name);

          }

          Post::create([
            'description' => $request->description,
            'body' => $request->body,
            'image1' => (isset($image1_name)) ? $image1_name : null,
            'image2' => (isset($image2_name)) ? $image2_name : null,
            'image3' => (isset($image3_name)) ? $image3_name : null,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category

          ]);

          return redirect('/home')->with('message', 'Your post is created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Showing the specified post by 'id'
    public function show($id)
    {
         $post = Post::find($id);
         $user = User::all()->where('id',$post->user_id)->first();
         if (auth()->check() && Auth::user()->id !== $post->user_id ) {

            $post->increment('views'); // Povecanje pregleda

         }

        $comments = Comment::all(); // Dodavanje komentara na post

         return view('singlePostView',compact('post','user','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // Showing the form for editing specified post by 'id'
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        return view('editPost',compact('post', 'categories'));


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Updating of the post
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $user = Auth::user();



        $request->validate([

         'description' => 'string|max:255|required',
         'body' =>  'required',
         'image1' => 'mimes:jpg,jpeg,png',
         'image2' => 'mimes:jpg,jpeg,png',
         'image3' => 'mimes:jpg,jpeg,png',
         'category' => 'required'
        ]);
        if ($request->hasFile('image1')) {

             $image1 = $request->file('image1');
             $image1_name = time().'1.'.$image1->extension();
             $image1->move(public_path('/images/post_images'),$image1_name);

        }
        if ($request->hasFile('image2')) {

             $image2 = $request->file('image2');
             $image2_name = time().'2.'.$image2->extension();
             $image2->move(public_path('/images/post_images'),$image2_name);

        }
        if ($request->hasFile('image3')) {

             $image3 = $request->file('image3');
             $image3_name = time().'3.'.$image3->extension();
             $image3->move(public_path('/images/post_images'),$image3_name);

        }

         $post->update([

             'description' => $request->description,
             'body' => $request->body,
             'image1' => (isset($image1_name)) ? $image1_name : null,
             'image2' => (isset($image2_name)) ? $image2_name : null,
             'image3' => (isset($image3_name)) ? $image3_name : null,
             'user_id' => Auth::user()->id,
             'category_id' => $request->category
         ]);

         return view('showSingleUserPost', compact('user','post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Deleting the post
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();


        return view('home', compact('user','posts'));

    }
}
