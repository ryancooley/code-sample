<?php

namespace App\Http\Controllers;

use App\Widget;
use App\Http\Resources\WidgetResource;
use Illuminate\Http\Request;

class WidgetAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new WidgetResource(Widget::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new WidgetResource(Widget::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new WidgetResource(Widget::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Widget::find($id)->update($request->all());
        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id) {
            Widget::destroy($id);
        }

        return $this->index();
    }
}
