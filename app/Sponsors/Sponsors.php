<?php namespace App\Sponsors;

class Sponsors
{
	protected $maintainers = [
		'itsgoingd'
	];

	protected $sponsors;

	public function all()
	{
		$this->load();

		return $this->sponsors;
	}

	public function set($sponsors)
	{
		$this->sponsors = $sponsors;

		return $this;
	}

	public function load()
	{
		$this->sponsors = file_exists(storage_path('sponsors.json'))
			? collect(json_decode(file_get_contents(storage_path('sponsors.json')), true)) : collect();

		return $this;
	}

	public function save()
	{
		file_put_contents(storage_path('sponsors.json'), $this->sponsors->toJson());

		return $this;
	}

	public function refresh()
	{
		app(Actions\Refresh::class)->handle($this, $this->maintainers);

		return $this;
	}
}
