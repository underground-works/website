<?php namespace App\Blog;

class Post
{
	public $date;
	public $slug;
	public $title;
	public $perex;
	public $content;
	public $authors;
	public $draft;

	public function __construct(array $metadata, $content)
	{
		$this->date    = now()->parse($metadata['date']) ?? null;
		$this->slug    = $metadata['slug'] ?? null;
		$this->title   = $metadata['title'] ?? null;
		$this->perex   = $metadata['perex'] ?? null;
		$this->content = $content;
		$this->authors = $metadata['authors'] ?? [];
		$this->draft   = $metadata['draft'] ?? false;
	}
}
