<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): View
    {
        return view('dashboard', [
            'bookmarks' => Bookmark::query()
                ->where('user_id', auth()->id())
                ->get()
        ]);
    }
}
