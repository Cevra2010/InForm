<?php

namespace Modules\Newsfeed\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Newsfeed\Entities\Article;
use Modules\Newsfeed\Entities\Newsfeed;
use Modules\Newsfeed\Http\Requests\StoreArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('newsfeed::index');
    }
    
    /**
     * Return the view of the article editor page
     *
     * @param  mixed $article
     * @return void
     */
    public function showArticleEditor(Article|null $article = null) {
        if($article->data['status'] != 'edit') {

            // Check for existing Edit-Article
            if($existingArticle = Article::where('data->original',$article->id)->first()){
                return redirect()->route("backend.newsfeed.article.editor",$existingArticle);
            }

            // Create new Edit-Article
            $editArticle = Article::create(
                [
                    'newsfeed_id' => $article->newsfeed_id,
                    'title' => $article->title,
                    'content' => $article->content,
                    'created_at' => $article->created_at,
                    'status' => 'edit',
                    'original' => $article->id,
                ]
            );
            return redirect()->route("backend.newsfeed.article.editor",$editArticle);
        }

        return view("newsfeed::article.editor",[
            'article' => $article,
        ]);
    }
    
    /**
     * Creates a new article and redirect to article editor
     *
     * @param  Newsfeed $newsfeed
     * @return Redirect
     */
    public function createNewArticle(Newsfeed $newsfeed) {
        $article = Article::create([
            'data' => [
                'title' => __('newsfeed.new-article'),
                'newsfeed_id' => $newsfeed->id,
                'status' => 'edit',
                'content' => null,
            ]
        ]);

        return redirect()->route("newsfeed::article.editor",$article);
    }

    public function publishArticle(Article $article) {
        dd("Article");
    }

    public function store(StoreArticleRequest $request,Article $article) {
        $article->data['content'] = $request->content;
        $article->data['title'] = $request->title;
        $article->save();
        session()->flash('success');
        return redirect()->route("newsfeed::dashbaord",$article->data['newsfeed_id']);
    }
}
