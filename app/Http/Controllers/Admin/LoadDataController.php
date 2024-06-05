<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers;


class LoadDataController extends Controller
{
    //
    public function loadData($func, Request $request)
    {
        if (method_exists($this, $func)) {
            return $this->{$func}($request);
        }

        return response()->json(
            [
                'status' => 'error',
                'message' => 'Function not found',
            ]
        );
    }
    protected function generateSlug(Request $request): \Illuminate\Http\JsonResponse
    {
        $title = Str::words($request->input('title'), 15);

        return response()->json(
            [
                'status' => true,
                'slug' => Str::slug(seo_string($title, 70)),
            ]
        );
    }
}
