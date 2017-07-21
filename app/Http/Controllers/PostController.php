<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use App\Category;
use Session;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //create a variable and store all the blog posts in it from the database
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        //return a view and pass in the avobe variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // dd($request);

        //validate the data
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'body'  => 'required',
            'featured_image' => 'sometimes|image'

            ));

        //store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->user_id = auth()->user()->id;
        $post->body = Purifier::clean($request->body);

        // Save Images

        if ($request->hasFile('featured_image')) {
           
           $image = $request->file('featured_image');
           $filename = time() . '.' . $image->getClientOriginalExtension();
           $location = public_path('images/'. $filename);
           Image::make($image)->resize(800, 400)->save($location);

           $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'The blog post was successfully save!');

        //redirect to anohter page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find the post in the database and save it in a variable.
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        $cats = [];
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tages = [];
        foreach ($tags as $tag) {
            $tages[$tag->id] = $tag->name;
        }

        //Return the view and pass in the variable we priviously created.
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tages);
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
        //Validate the data
        $post = Post::find($id);
        if($request->input('slug') == $post->slug){
             $this->validate($request, array(

            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'body' => 'required'
            ));
        }
        else{
        $this->validate($request, array(

            'title' => 'required|max:255',
            'slug' => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'category_id' => 'required|integer',
            'body' => 'required',
            'featured_image' => 'image'
            ));
        }

        //save the data to the database
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));

        //image upload
        if ($request->hasFile('featured_image')) {
            
            //add new photo
             $image = $request->file('featured_image');
             $filename = time() . '.' . $image->getClientOriginalExtension();
             $location = public_path('images/'. $filename);
             Image::make($image)->resize(400, 200)->save($location);
             $oldfilename = $post->image;

            //update the database
             $post->image = $filename;

            //delete the old photo
             Storage::delete($oldfilename);
        }

        $post->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        }else{
            $post->tags()->sync(array());
        }

        //Set flash data with success message

        Session::flash('success', 'The blog post is successfully updated!');

        //Redirect with flash data to posts.show

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $post->tags()->detach();

        Storage::delete($post->image);

        $post->delete();

        Session::flash('danger', 'The blog post is successfully deleted!');

        return redirect()->route('posts.index');
    }
}
