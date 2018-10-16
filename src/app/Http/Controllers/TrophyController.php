<?php

namespace Showcase\App\Http\Controllers;

use Illuminate\Http\Request;
use Showcase\App\Display;
use Showcase\App\Trophy;
use Showcase\App\Http\Requests\TrophyRequest;
use Showcase\Showcase;

class TrophyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('showcase::app.trophy.index', compact('trophies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $default_view = request()->display !== null
            ? Display::find($display)->default_trophy_component_view
            : null;
        
        $trophyViews = Showcase::getViewFilenamesBasic('trophy');

        return view(
            'showcase::app.trophy.create',
            compact('default_view', 'displays', 'trophyViews')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Showcase\App\Http\Requests\TrophyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrophyRequest $request)
    {
        $trophy = Trophy::create($request->except('displays'));

        $trophy->displays()->detach();
        $trophy->displays()->attach($request->displays);

        return redirect()->route(config('showcase.route_prefix', 'showcase') . '.trophies.show', compact('trophy'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Showcase\App\Trophy  $trophy
     * @return \Illuminate\Http\Response
     */
    public function show(Trophy $trophy)
    {
        return view('showcase::app.trophy.show', compact('trophy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Showcase\App\Trophy  $trophy
     * @return \Illuminate\Http\Response
     */
    public function edit(Trophy $trophy)
    {
        $trophyViews = Showcase::getViewFilenamesBasic('trophy');

        return view(
            'showcase::app.trophy.edit',
            compact('trophy', 'displays', 'trophyViews')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Showcase\App\Http\Requests\TrophyRequest  $request
     * @param  \Showcase\App\Trophy  $trophy
     * @return \Illuminate\Http\Response
     */
    public function update(TrophyRequest $request, Trophy $trophy)
    {
        $trophy->update($request->except('displays'));

        $trophy->displays()->detach();
        $trophy->displays()->attach($request->displays);

        flash()->success('Trophy updated!');

        return redirect()->route(config('showcase.route_prefix', 'showcase') . '.trophies.show', compact('trophy'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Showcase\App\Trophy  $trophy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trophy $trophy)
    {
        $trophy->displays()->detach();

        $trophy->delete();

        return redirect()->route(config('showcase.route_prefix', 'showcase') . '.trophies.index');
    }
}
