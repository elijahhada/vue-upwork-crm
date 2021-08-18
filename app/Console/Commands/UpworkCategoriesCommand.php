<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Topic;
use App\Services\Upwork\UpworkMetadataService;
use Illuminate\Console\Command;
use Upwork\API\Config;

class UpworkCategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upwork:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get upwork categories';

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
     * @return int
     */
    public function handle()
    {
        Config::set('redirectUri', url('/').'/auth/callback/console');
        $service = new UpworkMetadataService();
        Config::set('mode', 'nonweb');
        Config::set('redirectUri', url('/').'/auth/callback/console');

        $categories = $service->getCategories(0, 50);

        foreach($categories->categories as $category) {
            $categoryModel = Category::create([
                'title' => $category->title,
                'upwork_id' => $category->id,
            ]);

            foreach($category->topics as $topic) {
                Topic::create([
                    'title' => $topic->title,
                    'upwork_id' => $topic->id,
                    'category_id' => $categoryModel->id,
                ]);
            }
        }
    }
}
