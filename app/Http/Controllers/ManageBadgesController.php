<?php

namespace App\Http\Controllers;

use App\Models\WebsiteBadge;
use Illuminate\Http\Request;

class ManageBadgesController extends Controller
{

    public function index()
    {
        return view('manage-badge.index', [
            'badges' => WebsiteBadge::query()
                ->orderByDesc('id')
                ->paginate(15)
        ]);
    }

    public function accept(WebsiteBadge $badge){
        // Find all bans on the user & delete them
        $badge->status = 'accept';
        $badge->save();
        return to_route('manage-badges.index')->with('success', __('The badge has been accepted!'));
    }

    public function delete(WebsiteBadge $badge) {
        // Find all bans on the user & delete them
        WebsiteBadge::query()->where('id', $badge->id)->delete();
        return to_route('manage-badges.index')->with('success', 'The badge has been deleted!');
    }

    public function create(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:png,gif|max:2048|dimensions:width=40,max_height=40'
        ]);
        $path = $request->file('image')->store('', 'badges');
        WebsiteBadge::query()->create([
            'user_id' => $request->user()->id,
            'badge_imaging' => $path,
            'status' => 'open'
        ]);
        return to_route('manage-badges.index')->with('success', 'The badge has been submited!');
    }

}
