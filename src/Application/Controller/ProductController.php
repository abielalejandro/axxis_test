<?php
namespace App\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;
use App\Domain\Service\ProductService;
use App\Application\Mapper\ProductMapper;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api/v1/products')]
class ProductController extends AbstractController
{

    private LoggerInterface $logger;
    private ProductService $service;

    public function __construct(LoggerInterface $logger, ProductService $service) {
        $this->logger = $logger;
        $this->service = $service;
    }

    #[Route(methods: ["GET"])]
    public function index(): JsonResponse
    {
        $this->logger->info('Calling index');

        $products = $this->service->listProducts();
        return $this->json(ProductMapper::toProductsResponse($products));
    }

    #[Route(methods: ["POST"])]
    public function createProducts(Request $request): JsonResponse
    {
        $this->logger->info('Calling createProducts');

        $body = json_decode($request->getContent(), true);
        $products = ProductMapper::toProductsDomain($body);
        $this->service->createProducts($products);
        return $this->json(['sucess'=>true],201);
    }

    #[Route(methods: ["PUT"])]
    public function updateProducts(Request $request): JsonResponse
    {
        $this->logger->info('Calling updateProducts');

        $body = json_decode($request->getContent(), true);
        $products = ProductMapper::toProductsDomain($body);
        $this->service->updateProducts($products);
        return $this->json(['sucess'=>true],201);
    }

}