<?php

namespace App\Http\Controllers;

use App\Models\ExternalText;
use Illuminate\Http\Request;

class ExternalTextsController extends Controller
{

    public function index(Request $request)
    {
        $texts = ExternalText::query();

        if ($request->input('search')) {
            $texts->where($request->input('sort_by'), 'like', $request->input('sarch'));
        }

        return view('external-texts.index', [
            'texts' => $texts->orderByDesc('key')
                ->paginate(15)
        ]);
    }

    public function edit(ExternalText $externalText)
    {
        return view('external-texts.edit', [
            'text' => $externalText
        ]);
    }

    public function store(ExternalText $externalText, Request $request)
    {
        $request->validate([
            'value' => 'required'
        ]);
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
