<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( isset($request) ){
            $title = $request->input('title');
            $description = $request->input('description');
            $scheduledto = $request->input('scheduledto');
            $frame_id = $request->input('frameid');

            $user = Auth::user(); 
            $userId = $user->id;

            $post = Post::create([
                'title' => $title,
                'description' => $description,
                'scheduledto' => $scheduledto,
                'user_id' => $userId,
                'frame_id' => $frame_id,
            ]);

            Log::info('Post salvo: ' . $post->id);
            
            return response()->json($post, 200);
        }else{
            return response()->json(['resposta' => 'error'], 401);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($postId)
    {
        $post = Post::where('id', $postId)->with(['messages' => function($q) use ($postId) {
            $q->where('post_id', '=' , $postId);
        }])->get()->first();

        Log::info("post: " . $post);

        return response()->json($post,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if( isset($request) ){
            $id = $request->input('id');
            Log::info("deletando registro: " . $id);

            $post = Post::find($id);
            $post->delete($id);

            return response()->json(['resposta' => 'ok'], 200);
        }else{
            return response()->json(['resposta' => 'error'], 401);
        }
        
    }

    public function movimentar(Request $request)
    {
        if( isset($request) ){
            $id = $request->input('id');
            $frameId = $request->input('frame_id');

            Log::info("movimentando registro: " . $id);

            $post = Post::find($id);
            $post->frame_id = $frameId;
            $post->save();

            return response()->json(['resposta' => 'ok'], 200);
        }else{
            return response()->json(['resposta' => 'error'], 401);
        }
        
    }
}
