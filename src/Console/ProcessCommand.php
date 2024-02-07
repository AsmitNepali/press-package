<?php

namespace Vicgonvt\Press\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Vicgonvt\Press\Post;
use Vicgonvt\Press\PressFileParser;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';
    protected $description = 'Updates blog post.';

    public function handle()
    {
        // Fetch all posts
        $files = File::files('blogs');

        // Process each file
        foreach($files as $file) {
            $post = (new PressFileParser($file->getPathname()))->getData();
        }

        // Persist to the DB
        Post::create([
            'identifier' => Str::random(),
            'slug' => Str::slug($post['title']),
            'title' => $post['title'],
            'body' => $post['body'],
            'extra' => $post['extra'] ?? []
        ]);
    }
}