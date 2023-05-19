<?php

namespace App\Http\Controllers;

use App\Models\ExternalText;
use Illuminate\Http\Request;

class ExternalTextsController extends Controller
{

    public function index(Request $request)
    {
        $texts = ExternalText::query();

        if ($request->input('criteria')) {
            $texts = $texts->where($request->input('sort_by'), 'like', $request->input('criteria'));
        }

        return view('external-texts.index', [
            'texts' => $texts
                ->orderByDesc('asc')
                ->paginate(15)
        ]);
    }

    public function create()
    {
        return view('external-texts.create', [
            'text' => new ExternalText
        ]);
    }

    public function edit(ExternalText $externalText)
    {
        return view('external-texts.edit', [
            'text' => $externalText
        ]);
    }

    public function update(ExternalText $externalText, Request $request)
    {
        $request->validate([
            'key' => 'required',
            'value' => 'required'
        ]);
        $externalText->update([
            "key" => $request->input('key'),
            "value" => $request->input('value')
        ]);
        return to_route('external-texts.index')->with('success', 'The text has been updated!');
    }

    public function delete(ExternalText $externalText)
    {
        // Find all bans on the user & delete them
        ExternalText::query()->where('key', $externalText->key)->delete();
        return to_route('external-texts.index')->with('success', 'The text has been deleted!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required',
            'value' => 'required'
        ]);
        ExternalText::query()->create([
            'key' => $request->input('key'),
            'value' => $request->input('value'),
        ]);
        return to_route('external-texts.index')->with('success', 'The text has been created!');
    }

}
