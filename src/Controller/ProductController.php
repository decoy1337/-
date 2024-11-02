<?php
namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class ProductController extends AbstractController
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function search(Request $request): JsonResponse
    {
        $article = $request->query->get('Article');
        $apiKey = $request->query->get('api_key');

        if (!$article || !$apiKey) {
            return $this->json(['error' => 'Неверные параметры'], 400);
        }

        $data = $this->productService->searchProductByArticle($article, $apiKey);
        
        return $this->json($data);
    }
}
