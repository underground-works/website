<?php namespace App\Documentation;

use App\Support\Markdown\ParsedownParser;

use Illuminate\Support\ServiceProvider;

class DocumentationServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(DocumentsRepository::class, function($app)
		{
			return new DocumentsRepository(
				base_path('resources/views/docs'),
				new ParsedownParser
			);
		});
	}
}
