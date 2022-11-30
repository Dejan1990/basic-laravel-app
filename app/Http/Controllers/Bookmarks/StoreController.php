<?php
declare(strict_types=1);

namespace App\Http\Controllers\Bookmarks;

use App\Actions\Bookmarks\CreateBookmarkAndTags;
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
        (new CreateBookmarkAndTags())->handle(
            request: $request->all(), 
            id: auth()->id()
        );

        return to_route('dashboard');
    }
}
