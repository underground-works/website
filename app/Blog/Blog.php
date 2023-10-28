<?php namespace App\Blog;

class Blog
{
	protected $path;
	protected $parser;

	public function __construct($path, PostParser $parser)
	{
		$this->path   = $path;
		$this->parser = $parser;
	}

	public function all($includeDrafts = false)
	{
		return collect(glob("{$this->path}/*.md"))
			->map(function ($file) { return $this->parser->fromFile($file); })
			->when(! $includeDrafts, function ($posts) {
				return $posts->filter(function ($post) { return ! $post->draft; });
			})
			->sortByDesc('date');
	}

	public function allIncludingDrafts()
	{
		return $this->all(true);
	}

	public function latest()
	{
		return $this->all()->first();
	}

	public function post($slug)
	{
		return $this->allIncludingDrafts()->where('slug', $slug)->first();
	}
}
