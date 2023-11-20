<?php
namespace Modules\Newsfeed\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Newsfeed\Entities\Article;
use Modules\Newsfeed\Entities\Newsfeed;

class ArticleList extends Component {

    use WithPagination; 

    public $newsfeed;

    public function mount(Newsfeed $newsfeed) {
        $this->newsfeed = $newsfeed;
    }

    public function render() {
        $articles = Article::where('data->newsfeed_id',$this->newsfeed->id)->where('data->status','!=','edit')->paginate(4);
        return view("newsfeed::livewire.dashbaord.article-list",[
            'articles' => $articles,
        ]);
    }

}