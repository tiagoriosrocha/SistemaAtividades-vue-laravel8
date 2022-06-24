<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Frame;
use App\Models\Post;
use App\Models\Message;

class NovoUsuarioCadastrado
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;
        Log::info("EVENTO - Usuário cadastrado: " . $user->name);

        //CRIANDO O AMBIENTE INICIAL COM 3 FRAMES, 2 POSTS, 2 COMENTÁRIOS

        $framePlanejado = Frame::create([
            'title' => 'Planning',
            'color' => 'primary',
            'user_id' => $user->id
        ]);

        $frameExecutando = Frame::create([
            'title' => 'Running',
            'color' => 'secondary',
            'user_id' => $user->id
        ]);

        $frameConcluido = Frame::create([
            'title' => 'Done',
            'color' => 'info',
            'user_id' => $user->id
        ]);

        $post1 = Post::create([
            'title' => 'My first post',
            'description' => 'My first post description',
            'scheduledto' => '2022-12-31 23:59:00',
            'status' => '#urgente',
            'user_id' => $user->id,
            'frame_id' => $framePlanejado->id
        ]);

        $post2 = Post::create([
            'title' => 'My second post',
            'description' => 'My second post description',
            'scheduledto' => '2023-12-31 23:59:00',
            'status' => '#tranquilo',
            'user_id' => $user->id,
            'frame_id' => $framePlanejado->id
        ]);

        $comentario1 = Message::create([
            'title' => 'My first comment',
            'text' => 'My first comment text',
            'user_id' => $user->id,
            'post_id' => $post1->id
        ]);

        $comentario2 = Message::create([
            'title' => 'My second comment',
            'text' => 'My second comment text',
            'user_id' => $user->id,
            'post_id' => $post1->id
        ]);

    }
}
