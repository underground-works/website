<?php namespace App\Support\Twig;

class Helpers
{
	public static function includeAsset($path)
	{
		return file_get_contents(resource_path("assets/{$path}"));
	}
}
