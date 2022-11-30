<?php
declare(strict_types=1);

namespace App\Http\Controllers\Bookmarks;

use App\Models\Tag;
use App\Models\Bookmark;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'url' => [
                'required',
                'url',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'tags' => [
                'nullable',
            ]
        ]);
 
        $bookmark = auth()->user()->bookmarks()->create([
            'name' => $request->get('name'),
            'url' => $request->get('url'),
            'description' => $request->get('description'),
        ]);
 
        foreach (explode(',', $request->get('tags')) as $tag) {
            $tag = Tag::query()->firstOrCreate(
                ['name' => trim(strtolower($tag))],
            );
 
            $bookmark->tags()->attach($tag->id);
        }
 
        return redirect()->route('dashboard');
    }
}
