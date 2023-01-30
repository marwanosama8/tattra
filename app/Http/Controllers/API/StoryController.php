<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Custome\Response;
use App\Http\Requests\StoreStoryRequest;
use App\Http\Requests\UpdateStoryRequest;
use App\Http\Resources\StoryResource;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoryController extends Controller
{
    use Response;

    public function getAllStories()
    {
        $data = StoryResource::collection(Story::latest()->get());
        
        return $this->handleResponse($data,'OK');
    }

    public function getStory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'story_id' => ['required', 'string'],
        ], $messages = [
            'required' => 'The :attribute is required, please pass it',
        ]);
        if ($validator->fails()) {
           return $this->errorResponse($validator->errors());
        }
        $data = StoryResource::collection(Story::where('id',$request->get('story_id'))->get());
        return $this->handleResponse($data,'OK');
    }
}
