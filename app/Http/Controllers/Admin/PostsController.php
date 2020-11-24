<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Section;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 use Illuminate\Support\Str;
use App\Post;
use App\Category;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {


        $posts = Post::orderByDesc('id')->limit(10)->paginate(5);
        //$informes = Post::orderByDesc('id')->limit(2)->where('informe', "S")->get();

             return view('page.admin.post.index',
            [
                'posts' => $posts
            ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {

        $categorias = Category::all();
        $sections = Section::all();

        return view('page.admin.post.create', [
            'categorias' => $categorias,
            'sections' =>$sections
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $postagem = new Post();
        $postagem->title = $request->title;
        $postagem->subtitle = $request->subtitle;
        $postagem->content = $request->content;
        $postagem->tag = $request->tag;
        $postagem->user_id = auth()->user()->id;
        $postagem->link = Str::slug($postagem->title, "-");
        $postagem->category_id = $request->category_id;
        $postagem->save();
        if($request->hasFile('imagem')) {
            for ($i = 0; $i < count($request->allFiles()['imagem']); $i++) {
                $file = $request->allFiles()['imagem'][$i];
                $img = new File();
                $img->img = $file->store(Str::slug($postagem->title, "-"));
                $img->post_id = $postagem->id;
                $img->save();
                unset($img);
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($noticia)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}
