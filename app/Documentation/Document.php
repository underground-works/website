<?php namespace App\Documentation;

use App\Support\Markdown\Parser;

use SplFileInfo;

class Document
{
	public $slug;
	public $content;

	protected $markdownParser;

	public function __construct($slug, $content, Parser $markdownParser)
	{
		$this->slug    = $slug;
		$this->content = $content;

		$this->markdownParser = $markdownParser;
	}

	public function html()
	{
		return $this->markdownParser->parse($this->content);
	}

	public static function fromFile(SplFileInfo $file, Parser $markdownParser)
	{
		$slug    = $file->getBasename('.md');
		$content = file_get_contents($file->getPathname());

		return new static($slug, $content, $markdownParser);
	}
}
