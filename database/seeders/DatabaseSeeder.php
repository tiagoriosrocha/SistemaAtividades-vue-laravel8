<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Frame;
use App\Models\Post;
use App\Models\Message;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $umUsuário = User::create([
            'name' => 'Tiago Rios da Rocha',
            'email' => 'tiago.rios@ibiruba.ifrs.edu.br',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $framePlanejado = Frame::create([
            'title' => 'Planejado',
            'color' => 'primary',
            'user_id' => $umUsuário->id
        ]);

        $frameExecutando = Frame::create([
            'title' => 'Executando',
            'color' => 'secondary',
            'user_id' => $umUsuário->id
        ]);

        $frameConcluido = Frame::create([
            'title' => 'Concluido',
            'color' => 'info',
            'user_id' => $umUsuário->id
        ]);

        $post1 = Post::create([
            'title' => 'Meu primeiro post',
            'Description' => 'meu primeiro post desc',
            'scheduledto' => '2022-12-31 23:59:00',
            'status' => '#urgente',
            'user_id' => $umUsuário->id,
            'frame_id' => $framePlanejado->id
        ]);

        $post2 = Post::create([
            'title' => 'Meu segundo post',
            'Description' => 'meu segundo post desc',
            'scheduledto' => '2023-12-31 23:59:00',
            'status' => '#tranquilo',
            'user_id' => $umUsuário->id,
            'frame_id' => $framePlanejado->id
        ]);

        $comentario1 = Message::create([
            'title' => 'Meu primeiro comentário',
            'text' => 'Meu primeiro comentário desc',
            'user_id' => $umUsuário->id,
            'post_id' => $post1->id
        ]);

        $comentario2 = Message::create([
            'title' => 'Meu segundo comentário',
            'text' => 'Meu segundo comentário desc',
            'user_id' => $umUsuário->id,
            'post_id' => $post1->id
        ]);


        
    }
}
