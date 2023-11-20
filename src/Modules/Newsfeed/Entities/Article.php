<?php

namespace Modules\Newsfeed\Entities;

use App\Components\ContentManager\Content;
use Illuminate\Database\Eloquent\Model;

class Article extends Content
{
    public function newsfeed() {
        return $this->hasOne(Newsfeed::class,'data.newsfeed_id','newsfeed_id');
    }

    public function originalArticle() {
        return $this->hasOne(Article::class,'id','original');
    }
}
