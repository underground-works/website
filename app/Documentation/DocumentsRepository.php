<?php namespace App\Documentation;

use App\Support\Markdown\Parser;

use DirectoryIterator;

class DocumentsRepository
{
	protected $documentsPath;
	protected $markdownParser;

	public function __construct($documentsPath, Parser $markdownParser)
	{
		$this->documentsPath  = $documentsPath;
		$this->markdownParser = $markdownParser;
	}

	public function all()
	{
		$documents = [];

		foreach (new DirectoryIterator($this->documentsPath) as $file) {
			if ($file->isDot()) continue;

			$documents[] = Document::fromFile($file, $this->markdownParser);
		}

		return collect($documents);
	}

	public function find($slug)
	{
		return $this->all()->where('slug', $slug)->first();
	}
}
