<?php

namespace App\Controller\Api;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiPostController extends AbstractController
{
	public function __construct(private PostRepository $repository, private SerializerInterface $serializer)
	{
//		header('Access-Control-Allow-Origin: *');
//		header("Access-Control-Allow-Methods: *");

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Allow: GET, POST, OPTIONS, PUT, DELETE");
	}
    #[Route('/api/post', name: 'app_api_post',methods: ["GET"])]
    public function index(): Response
    {
		$posts = $this->repository->findAll();

		$json = $this->serializer->serialize($posts,"json");
		$response = new Response($json);
		$response->headers->set("Content-Type","application/json");
		return $response;
    }

	#[Route('/api/post', name: 'app_api_post_create', methods: ["POST"])]
	public function create(Request $request): Response
	{
		$body = file_get_contents('php://input');
		$body=json_decode($body, TRUE);
//		print_r($body);
//		die();
		$fileName = md5(microtime()).".jpg";
		$post = new Post();
		$post->setTitle($body["title"]);
		$post->setContent($body["content"]);
		$post->setCreated(new \DateTime("now"));
		$post->setUpdated(new \DateTime("now"));
		$post->setImage($fileName);
		$post->setStatus(0);
		$this->repository->save($post, true);
		$json = $this->serializer->serialize($post,"json");
		$output_file = __DIR__."/../../../public/files/$fileName";
		file_put_contents($output_file, file_get_contents($body["file"]));

		$response = new Response($json);
		$response->headers->set("Content-Type","application/json");
//		header('Access-Control-Allow-Origin: *');
//		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
//		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
//		header("Allow: GET, POST, OPTIONS, PUT, DELETE");

		return $response;
	}

	#[Route('/api/post/{id}', name: 'app_api_post_update', methods: ["PUT"])]
	public function update(int $id): Response
	{
		$body = file_get_contents('php://input');
		$body = json_decode($body, TRUE);

		$post = $this->repository->find($id);

		if ($post == null){
			$response = new Response(json_encode(["message"=> "post not found", ]));
			$response->headers->set("Content-Type","application/json");
			$response->headers->set("Status",Response::HTTP_NOT_FOUND);
			return $response;
		}

		$post->setTitle($body["title"]);
		$post->setContent($body["content"]);
		$post->setUpdated(new \DateTime('now'));
		$this->repository->save($post, true);
		$json = $this->serializer->serialize($post,"json");

		$response = new Response($json);
		$response->headers->set("Content-Type","application/json");
		return $response;
	}
	#[Route('/api/post/{id}', name: 'app_api_post_get', methods: ["GET"])]
	public function getById(int $id): Response
	{
		$post = $this->repository->find($id);

		if ($post == null){
			$response = new Response(json_encode(["message"=> "post not found", ]));
			$response->headers->set("Content-Type","application/json");
			$response->headers->set("Status",Response::HTTP_NOT_FOUND);
			return $response;
		}
		$json = $this->serializer->serialize($post,"json");
		$response = new Response($json);
		$response->headers->set("Content-Type","application/json");
		return $response;
	}
}
