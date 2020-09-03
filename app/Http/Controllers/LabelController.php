<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        $this->authorizeResource(Label::class, 'label', ['except' => ['index']]);
    }

    public function index()
    {
        $labels = Label::all();

        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        return view('labels.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:labels',
            'description' => 'required'
        ]);

        $label = new Label();
        $label->fill($data);
        $label->save();

        flash(__('labels.store'))->success()->important();

        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:labels,name,' . $label->id,
            'description' => 'required'
        ]);

        $label->fill($data);
        $label->save();

        flash(__('labels.update'))->success()->important();

        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
    {
        $label->delete();

        flash(__('labels.destroy'))->success()->important();

        return redirect()->route('labels.index');
    }
}
