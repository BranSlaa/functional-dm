<?php

namespace App\Http\Controllers;

use App\SpellList;
use Illuminate\Http\Request;

class SpellListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SpellList::latest()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:500'
        ]);
        return SpellList::create([ 'name' => request('name') ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SpellList  $spellList
     * @return \Illuminate\Http\Response
     */
    public function show(SpellList $spellList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpellList  $spellList
     * @return \Illuminate\Http\Response
     */
    public function edit(SpellList $spellList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpellList  $spellList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpellList $spellList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpellList  $spellList
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpellList $id)
    {
        $spell = SpellList::findOrFail($id);
        $spell->delete();
        return 204;
    }
}
