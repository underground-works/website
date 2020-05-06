<?php namespace App\Chat;

class Members
{
	protected $members;

	public function all()
	{
		$this->load();

		return $this->members;
	}

	public function set($members)
	{
		$this->members = $members;

		return $this;
	}

	public function load()
	{
		$this->members = file_exists(storage_path('chat-members.json'))
			? collect(json_decode(file_get_contents(storage_path('chat-members.json')), true)) : collect();

		return $this;
	}

	public function save()
	{
		file_put_contents(storage_path('chat-members.json'), $this->members->toJson());

		return $this;
	}

	public function refresh()
	{
		app(Actions\RefreshMembers::class)->handle($this);

		return $this;
	}
}
