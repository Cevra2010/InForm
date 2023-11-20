<?php
namespace Modules\Newsfeed\Livewire\Article;

use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Newsfeed\Entities\Article;

class ArticleEditor extends Component {

    public $original;
    public $article;
    public $contentIsDirty = false;
    public $lastAutoSave;

    public function mount(Article $article) {
        $this->article = $article;
        $this->lastAutoSave = Carbon::now();
    }

    #[On('new-form-data')]
    public function getNewFormData($content) {
        $this->article->data['content'] = $content;
        $this->article->save();
        $this->lastAutoSave = Carbon::now();
    }

    public function render() {
        return view("newsfeed::livewire.article.editor");
    }
}