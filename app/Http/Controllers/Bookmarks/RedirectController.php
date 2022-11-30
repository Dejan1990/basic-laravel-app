<?php
declare(strict_types=1);

namespace App\Http\Controllers\Bookmarks;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use JustSteveKing\UriBuilder\Uri;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Bookmark $bookmark)
    {
        $url = Uri::fromString(
            uri: $bookmark->url,
        )->addQueryParam(
            key: 'utm_campaign',
            value: 'bookmarker_' . auth()->id(),
        )->addQueryParam(
            key: 'utm_source',
            value: 'Bookmarker App'
        )->addQueryParam(
            key: 'utm_medium',
            value: 'website',
        );
 
        return redirect(
            $url->toString(),
        );
    }
}
