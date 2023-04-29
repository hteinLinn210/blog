<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'detail');
    }


    public function index()
    {
        $data = Article::latest()->paginate(5);

        return view("articles.index", [
            "articles" => $data
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);

        return view("articles.detail", [
            'article' => $article
        ]);
    }

    public function add()
    {
        $categories = Category::all();

        return view("articles.add", [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $articles = new Article;
        $articles->title = request()->title;
        $articles->body = request()->body;
        $articles->category_id = request()->category_id;
        $articles->user_id = auth()->user()->id;
        $articles->save();

        return redirect("/articles")->with("info", "An article is added");
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();

        return view("articles.edit", [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $articles =  Article::find($id);
        $articles->title = request()->title;
        $articles->body = request()->body;
        $articles->category_id = request()->category_id;
        $articles->user_id = auth()->user()->id;
        $articles->save();

        return redirect("/articles")->with("info", "An article is updated");
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if (Gate::allows('delete-article', $article)) {
            $article->delete();
            return redirect("/articles")->with("info", "An article is deleted");
        }

        return back()->with('info', 'Unauthorize to delete');
    }
}
