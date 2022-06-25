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
                'time' => '00:00:00'
            ]);

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
        }, 'situations'])->get()->first();

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
    public function update(Request $request)
    {
        $id = $request->input('id');
        $campo = $request->input('campo');
        $valor = $request->input('valor');

        $post = Post::where('id',$id)->get()->first();
        $post->$campo = $valor;
        $post->save();

        return response()->json($post,200);
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

            $post = Post::find($id);
            $post->frame_id = $frameId;
            $post->save();

            return response()->json(['resposta' => 'ok'], 200);
        }else{
            return response()->json(['resposta' => 'error'], 401);
        }
    }

    public function setSituation(Request $request){
        if( isset($request) ){
            $post_id = $request->input('post_id');
            $situation_id = $request->input('situation_id');
            $habilitar = $request->input('habilitar');

            $post = Post::find($post_id);

            if($habilitar){
                $post->situations()->attach($situation_id);
            }else{
                $post->situations()->detach($situation_id);
            }
            

            return response()->json($post, 200);
        }else{
            return response()->json(['resposta' => 'error'], 401);
        }
    }
}
