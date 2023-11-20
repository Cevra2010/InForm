<?php

namespace Modules\Newsfeed\Http\Controllers;

use App\Models\Group;
use Components\InformDataTable\DataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Newsfeed\Entities\Article;
use Modules\Newsfeed\Entities\Newsfeed;
use Modules\Newsfeed\Http\Requests\StoreNewsfeedRequets;

class NewsfeedController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $newsfeeds = newsfeed::all();

        return view('newsfeed::index', [
            'newsfeeds' => $newsfeeds,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function addNewsfeedForm()
    {
        return view('newsfeed::add-newsfeed-form');
    }

    public function storeNewNewsfeed(StoreNewsfeedRequets $request) {
        $newsfeed = Newsfeed::create($request->all());
        session()->flash('success');
        return redirect()->route("backend.newsfeed.show",$newsfeed);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function showNewsfeedSettings(Newsfeed $newsfeed)
    {
        return view('newsfeed::show',[
            'newsfeed' => $newsfeed,
        ]);
    }

    public function showNewsfeedDashbaord(Newsfeed $newsfeed) {
        DataTable::getTable('newsfeed::edit-table')
        ->addWhereCondition('data->newsfeed_id',$newsfeed->id);
        return view("newsfeed::dashbaord",[
            'newsfeed' => $newsfeed,
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateSettings(StoreNewsfeedRequets $request,Newsfeed $newsfeed)
    {
        $newsfeed_read = json_decode($request->get('newsfeed_read'));
        $newsfeed_write = json_decode($request->get('newsfeed_write'));
        $newsfeed_publish = json_decode($request->get('newsfeed_publish'));

        $newsfeed->groupsRead()->detach();
        $newsfeed->groupsWrite()->detach();
        $newsfeed->groupsPublish()->detach();

        foreach($newsfeed_read as $read) {
            $newsfeed->groupsRead()->attach(Group::find($read->id));
        }

        foreach($newsfeed_write as $write) {
            $newsfeed->groupswrite()->attach(Group::find($write->id));
        }

        foreach($newsfeed_publish as $publish) {
            $newsfeed->groupsPublish()->attach(Group::find($publish->id));
        }

        $newsfeed->fill($request->only('name'))->save();
        session()->flash('success');
        
        return redirect()->route("newsfeed::index");
    }
}
