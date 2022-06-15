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
            'title' => 'Planejado',
            'color' => 'primary',
            'user_id' => $user->id
        ]);

        $frameExecutando = Frame::create([
            'title' => 'Executando',
            'color' => 'secondary',
            'user_id' => $user->id
        ]);

        $frameConcluido = Frame::create([
            'title' => 'Concluido',
            'color' => 'info',
            'user_id' => $user->id
        ]);

        $post1 = Post::create([
            'title' => 'Meu primeiro post',
            'description' => 'meu primeiro post desc',
            'scheduledto' => '2022-12-31 23:59:00',
            'status' => '#urgente',
            'user_id' => $user->id,
            'frame_id' => $framePlanejado->id
        ]);

        $post2 = Post::create([
            'title' => 'Meu segundo post',
            'description' => 'meu segundo post desc',
            'scheduledto' => '2023-12-31 23:59:00',
            'status' => '#tranquilo',
            'user_id' => $user->id,
            'frame_id' => $framePlanejado->id
        ]);

        $comentario1 = Message::create([
            'title' => 'Meu primeiro comentário',
            'text' => 'Meu primeiro comentário desc',
            'user_id' => $user->id,
            'post_id' => $post1->id
        ]);

        $comentario2 = Message::create([
            'title' => 'Meu segundo comentário',
            'text' => 'Meu segundo comentário desc',
            'user_id' => $user->id,
            'post_id' => $post1->id
        ]);

    }
}
