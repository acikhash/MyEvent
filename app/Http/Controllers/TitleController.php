<?php

namespace App\Http\Controllers;

use App\Models\Title;
use App\Http\Requests\StoreTitleRequest;
use App\Http\Requests\UpdateTitleRequest;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTitleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Title $title)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Title $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTitleRequest $request, Title $title)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Title $title)
    {
        //
    }
}
