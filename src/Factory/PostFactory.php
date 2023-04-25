<?php

namespace App\Factory;

use App\Entity\Post;
use DateTime;
use Faker\Factory;

class PostFactory
{
	public static function create(): Post
	{
		$faker = Factory::create();

		$post = new Post();
		$post->setTitle($faker->sentence);
		$post->setContent($faker->paragraphs(3, true));
		$post->setImage($faker->imageUrl());
		$post->setStatus(1);
		$post->setCreated(new DateTime());
		$post->setUpdated(new DateTime());

		return $post;
	}
}
