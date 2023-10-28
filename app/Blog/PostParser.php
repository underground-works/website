<?php namespace App\Blog;

use App\Support\Markdown\Parser;

use Symfony\Component\Yaml\Yaml;

class PostParser
{
	protected $markdownParser;

	public function __construct(Parser $markdownParser)
	{
		$this->markdownParser = $markdownParser;
	}

	public function fromFile($path)
	{
		$content = file_get_contents($path);

		return $this->parse(basename($path, '.md'), $content);
	}

	public function parse($filename, $content)
	{
		$metadata = array_merge(
			$this->parseFilename($filename),
			$this->parseMetadata($content)
		);

		$metadata['authors'] = $this->parseAuthors($metadata['authors']);
		$metadata['perex'] = $this->markdownParser->parse($metadata['perex']);

		$content = $this->markdownParser->parse($content);
		$content = preg_replace('#<h1>.+?</h1>\n#s', '', $content);

		return new Post($metadata, $content);
	}

	protected function parseFilename($filename)
	{
		return [
			'date'  => preg_match('/^(\d+-\d+-\d+)/', $filename, $matches) ? $matches[1] : null,
			'slug'  => preg_match('/^\d+-\d+-\d+-(.*)/', $filename, $matches) ? strtolower($matches[1]) : null,
			'draft' => preg_match('/-draft$/', $filename)
		];
	}

	protected function parseMetadata($content)
	{
		$metadata = [
			'title' => preg_match('/# (.+?)\n/s', $content, $matches) ? $matches[1] : null
		];

		if (preg_match('/<!--\n(.+?)-->\n/s', $content, $matches)) {
			$metadata = array_merge($metadata, Yaml::parse($matches[1]));
		}

		return $metadata;
	}

	protected function parseAuthors($authors)
	{
		return collect($authors)->map(function ($author) {
			preg_match('/(?<name>[^ ]+)(?: \(@(?<twitter>.+?)\))?/', $author, $matches);

			return [
				'name'     => $matches['name'],
				'twitter'  => $matches['twitter'] ?? null,
				'imageUrl' => 'https://avatars.githubusercontent.com/u/821582?v=3'
			];
		});
	}
}
