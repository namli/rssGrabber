<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Feeds as FeedModel;
use App\Model\Posts as PostModel;
use App\Http\Controllers\PostController;

class getPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get posts from rss feeds';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        (new PostController)->getPostsFromFeed();
    }
}
