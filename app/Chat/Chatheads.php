<?php namespace App\Chat;

class Chatheads
{
	protected $members;

	protected $colors = [
		'#00c09a', '#00d166', '#0099e1', '#a652bb', '#fd0061', '#f8c300', '#f9312f', '#91a6a6', '#597e8d'
	];

	protected $parallax = [
		'large' => 25, 'medium' => 50, 'small' => 75
	];

	public function __construct($members)
	{
		$this->members = collect($members);
	}

	public static function make($members)
	{
		return new static($members);
	}

	public function generate()
	{
		$members = $this->shuffleMembers();

		$shownCount = min($members->count(), 30);

		$sizeRemaining = [
			'large' => 10 * $shownCount / 100,
			'medium' => 40 * $shownCount / 100,
			'small' => 50 * $shownCount / 100
		];

		return $members->take($shownCount)->reduce(function ($chatheads, $member) use (&$sizeRemaining) {
			return $chatheads->push([
				'member'   => $member,
				'position' => $position = $this->resolvePosition($member, $chatheads),
				'size'     => $size = $this->resolveSize($sizeRemaining),
				'style'    => $this->positionToStyle($position),
				'parallax' => $this->parallax[$size]
			]);
		}, collect());
	}

	protected function shuffleMembers()
	{
		[ $maintainers, $members ] = $this->members->partition(
			fn($member) => in_array('Maintainers', $member['roles'])
		);

		return $maintainers->shuffle()
			->merge($members->shuffle());
	}

	protected function resolvePosition($member, $chatheads)
	{
		$width = 0;
		$height = 240;

		$side = $chatheads->count() % 2 == 0;

		$chatheads = $chatheads->filter(fn($chathead) => $chathead['position']['side'] == $side);

		for ($i = 0; $i < 1000; $i++) {
			$x = rand(0, $width);
			$y = rand(0, $height);

			$conflicts = $chatheads->some(function ($chathead) use ($x, $y) {
				$size = [ 'large' => 106, 'medium' => 82, 'small' => 66 ][$chathead['size']] ?? 66;

				return $x + $size >= $chathead['position']['x'] && $x <= $chathead['position']['x'] + $size
					&& $y + $size >= $chathead['position']['y'] && $y <= $chathead['position']['y'] + $size;
			});

			if (! $conflicts) break;

			$width += 1;
		}

		return compact('side', 'x', 'y');
	}

	protected function resolveSize(&$sizeRemaining)
	{
		if ($sizeRemaining['large']-- > 0) {
			return 'large';
		} elseif ($sizeRemaining['medium']-- > 0) {
			return 'medium';
		} else {
			return 'small';
		}
	}

	protected function positionToStyle($position)
	{
		$color = collect($this->colors)->random();

		if ($position['side'] == 'left') {
			return "left: calc(50% - 360px - {$position['x']}px); top: {$position['y']}px; background: {$color}";
		} else {
			return "left: calc(50% + 300px + {$position['x']}px); top: {$position['y']}px; background: {$color}";
		}
	}
}
