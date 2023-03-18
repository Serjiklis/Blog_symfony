<?php

namespace App\Controller\Api;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ApiPostController extends AbstractController
{
    #[Route('/api/post', name: 'app_api_post',methods: ["GET"])]
    public function index(PostRepository $repository, SerializerInterface $serializer): Response
    {
		$posts = $repository->findAll();

		$json = $serializer->serialize($posts,"json");
		$response = new Response($json);
		$response->headers->set("Content-Type","application/json");
		return $response;
    }

	#[Route('/api/post', name: 'app_api_post_create', methods: ["POST"])]
	public function createPost(PostRepository $repository, SerializerInterface $serializer, Request $request): Response
	{
		$body = file_get_contents('php://input');
		$body=json_decode($body, TRUE);
//		print_r($body);
//		die();
		$post = new Post();
		$post->setTitle($body["title"]);
		$post->setContent($body["description"]);
		$post->setCreated(new \DateTime("now"));
		$post->setUpdated(new \DateTime("now"));
		$post->setImage("xx");
		$post->setStatus(0);
		$repository->save($post, true);
		$json = $serializer->serialize($post,"json");

		$response = new Response($json);
		$response->headers->set("Content-Type","application/json");
		return $response;
	}
}
