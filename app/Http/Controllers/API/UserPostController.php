<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Post;
use DB;

class UserPostController extends BaseController
{
    //
    public function postListing (Request $request){
        /* start email and password validation */
            $validator = Validator::make($request->all(), [
                'postType'  => 'required|in:posts,events,services,pages',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }   
        /* end email and password validation */
        $postList = Post::select(
            'id',
            'title',
            'thumbnail',
            'slug',
            'description',
            'content',
            'json_metas',
            'json_taxonomies',
            DB::RAW('DATE_FORMAT(created_at, "%M %d, %Y %h:%i:%s %p") as display_created_at'),
            'created_at',
            'type',
            'status',
        );
        $postList->where('type', '=', $request->postType);
        $postInfo = $postList->get()->toArray();

        if(!empty($postInfo)){
            return $this->sendResponse($postInfo, ucfirst($request->postType).' Listing Successfully.', 'success');
        }else{
            return $this->sendError('something is wrong.', ['error'=>'something is wrong']);
        }
    }
}
