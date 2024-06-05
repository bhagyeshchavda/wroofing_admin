<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostMetas;
use App\Models\User;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AjaxDataController extends Controller
{
    //
    public function getStringRaw(Request $request, string $func)
    {
        if ($func === 'SeoContent') {
            $title = $request->input('title');
            $description = $request->input('description');
            $slug = $request->input('slug');

            if (empty($slug)) {
                $slug = $title;
            }

            return response()->json(
                [
                    'title' => seo_string($title, 70),
                    'description' => seo_string($description, 195),
                    'slug' => Str::slug(seo_string($slug, 70)),
                ]
            );
        } elseif ($func === 'checkSlugAvai') {

            try {
                $checkSlugAvai = Post::where('slug', $request->slug)->get()->toArray();
                if (!empty($checkSlugAvai)) {
                    return response()->json([
                        'success' => false,
                        'slug' => $request->current_slug,
                        'message' => 'Unable to get slug.',
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'slug' => $request->slug,
                        'message' => 'new slug.',
                    ], 200);
                }
            } catch (\Exception $ex) {
                logMsg($ex);
                return response()->json([
                    'success' => true,
                    'message' => 'Unable to get slug.',
                ], 200);
            }
        }
    }
}