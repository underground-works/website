<?php namespace App\Contributors;

class Contributors
{
	protected $changelogs = [
		'https://raw.githubusercontent.com/itsgoingd/clockwork/master/CHANGELOG.md',
		'https://raw.githubusercontent.com/itsgoingd/clockwork-chrome/master/CHANGELOG.md',
		'https://raw.githubusercontent.com/itsgoingd/clockwork-firefox/master/CHANGELOG.md',
		'https://raw.githubusercontent.com/underground-works/clockwork-app/master/CHANGELOG.md'
	];

	protected $contributors;

	public function all()
	{
		$this->load();

		return $this->contributors;
	}

	public function set($contributors)
	{
		$this->contributors = $contributors;

		return $this;
	}

	public function load()
	{
		$this->contributors = file_exists(storage_path('contributors.json'))
			? collect(json_decode(file_get_contents(storage_path('contributors.json')), true)) : collect();

		return $this;
	}

	public function save()
	{
		file_put_contents(storage_path('contributors.json'), $this->contributors->toJson());

		return $this;
	}

	public function refresh()
	{
		app(Actions\Refresh::class)->handle($this, $this->changelogs);

		return $this;
	}
}
