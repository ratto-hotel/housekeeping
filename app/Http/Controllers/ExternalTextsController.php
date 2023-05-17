<?php

namespace App\Http\Controllers;

use App\Models\ExternalText;
use Illuminate\Http\Request;

class ExternalTextsController extends Controller
{

    public function index()
    {
        return view('external-texts.index', [
            'texts' => ExternalText::query()
                ->orderByDesc('key')
                ->paginate(15)
        ]);
    }

    public function edit(ExternalText $externalText)
    {
        return view('external-texts.edit')->withInput($externalText);
    }

    public function update(ExternalText $externalText, Request $request)
    {
        $externalText->update(["value" => $request->input('value')]);
        return to_route('external-texts.index')->with('success', 'The text has been updated!');
    }

    public function delete(ExternalText $externalText)
    {
        // Find all bans on the user & delete them
        ExternalText::query()->where('key', $externalText->key)->delete();
        return to_route('external-texts.index')->with('success', 'The text has been deleted!');
    }

    public function create(Request $request)
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
