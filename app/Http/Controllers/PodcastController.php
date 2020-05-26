<?php

namespace App\Http\Controllers;

use App\Http\Resources\PodcastResource;
use App\Http\Resources\PodcastResourceCollection;
use App\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $podcasts = Podcast::get();

        return view('dashboard.podcast.index', compact('podcasts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.podcast.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $attributes = request()->validate([
            'title' => 'required',
            'url' => 'required',
        ]);

        Podcast::create($attributes);

        request()->session()->flash('message', 'New member was added successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function show(Podcast $podcast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function edit(Podcast $podcast)
    {
        return view('dashboard.podcast.edit', compact('podcast'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Podcast $podcast)
    {
        $podcast->update(request()->all());

        request()->session()->flash('message', 'The information was updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function destroy(Podcast $podcast)
    {
         $podcast->delete();

        return back();
    }

    /**
     * [podcastIndex description]
     * @return [type] [description]
     */
    public function podcastIndex(): PodcastResourceCollection
    {
        return new PodcastResourceCollection(Podcast::paginate());
    }

    /**
     * [podcastDisplay description]
     * @param  Podcast  $podcast [description]
     * @return [type]        [description]
     */
    public function podcastDisplay(Podcast $podcast): PodcastResource
    {
        return new PodcastResource($podcast);
    }
}