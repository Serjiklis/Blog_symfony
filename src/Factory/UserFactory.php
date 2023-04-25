<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;

class UserFactory
{

	private $name;
	private $email;
	private $password;
	private $roles;

	private $userRepository;

//	public function __construct( UserRepository $userRepository)
//	{
//		$this->userRepository = $userRepository;
//	}
	public static function new(): self
	{
		return new self();
	}

	public function withName(string $name): self
	{
		$this->name = $name;
		return $this;
	}
	public function withEmail(string $email): self
	{
		$this->email = $email;

		return $this;
	}

	public function withPassword(string $password): self
	{
		$this->password = $password;

		return $this;
	}

	public function withRoles(array $roles): self
	{
		$this->roles = $roles;

		return $this;
	}

	public function create(): User
	{
		$user = new User();
		$user->setUsername($this->name);
		$user->setEmail($this->email);
		$user->setPassword($this->password);
		$user->setRoles($this->roles ?: ['ROLE_USER']);


		return $user;
	}

}
