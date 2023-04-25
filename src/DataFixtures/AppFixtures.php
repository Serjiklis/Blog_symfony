<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\UserFactory;



class AppFixtures extends Fixture
{
	public function load(ObjectManager $manager): void
	{
		// Load Users
		UserFactory::new()
			->withName('Superadmin')
			->withEmail('superadmin@example.com')
			->withPassword('adminpass')
			->withRoles(['ROLE_SUPER_ADMIN'])
			->create();

		UserFactory::new()
			->withName('Admin')
			->withEmail('admin@example.com')
			->withPassword('adminpass')
			->withRoles(['ROLE_ADMIN'])
			->create();

		UserFactory::new()
			->withName('Moderator')
			->withEmail('moderatoradmin@example.com')
			->withPassword( 'adminpass')
			->withRoles(['ROLE_MODERATOR'])
			->create();

	}
}
