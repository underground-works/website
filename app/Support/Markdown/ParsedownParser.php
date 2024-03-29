<?php namespace App\Support\Markdown;

use App\Support\Markdown\Parsedown\Parsedown;

class ParsedownParser implements Parser
{
	protected $parsedown;

	public function __construct()
	{
		$this->parsedown = new Parsedown;
	}

	public function parse($markdown)
	{
		return $this->parsedown->text($markdown);
	}
}
