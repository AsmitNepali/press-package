<?php

namespace Vicgonvt\Press\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Vicgonvt\Press\Post;
use Vicgonvt\Press\Facades\Press;

class ProcessCommand extends Command
{
    protected $signature = 'press:process';
    protected $description = 'Updates blog post.';

    public function handle()
    {
        // Fetch all posts
        if (Press::configNotPublished()) {
            return $this->warn('Please publish the config file by running \'php artisan vendor:publish --tag=press-config\'');
        }

        try {
            $posts = Press::driver()->fetchPosts();

            foreach ($posts as $post) {
                // Persist to the DB
                Post::create([
                    'identifier' => $post['identifier'],
                    'slug' => Str::slug($post['title']),
                    'title' => $post['title'],
                    'body' => $post['body'],
                    'extra' => $post['extra'] ?? []
                ]);
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}