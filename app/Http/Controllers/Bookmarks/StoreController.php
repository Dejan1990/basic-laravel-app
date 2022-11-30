<?php
declare(strict_types=1);

namespace App\Http\Controllers\Bookmarks;

use App\Models\Tag;
use App\Models\Bookmark;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bookmark\StoreRequest;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): RedirectResponse
    {
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
