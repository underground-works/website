<?php namespace App\Support\Markdown\Parsedown;

class Parsedown extends \Parsedown
{
	protected function blockFencedCode($Line, $Block = null)
	{
		if ($Block = parent::blockFencedCode($Line, $Block)) {
			$Block['element']['text']['attributes'] = [ 'class' => 'block' ];

			return $Block;
		}
	}
}
