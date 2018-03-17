<?php namespace App\Blog;

use App\Support\Markdown\ParsedownParser;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(Blog::class, function ($app) {
			return new Blog(base_path('blog'), new PostParser(new ParsedownParser));
		});
	}
}
