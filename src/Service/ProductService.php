<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductService
{
    private $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function searchProductByArticle(string $article, string $apiKey)
    {
        // я так и не понял на какой url отправлять запрос ,
        // не понимаю документации вашего поставщика пробовал /search и все перечисленные
        //  у него
        //  и поэтому уже не знаю так как никаких адекватных документаций не нашел
        $response = $this->client->request('GET', 'http://api.tmparts.ru/ArticleBrandList', [
            'query' => [
                'Article' => $article,
                'api_key' => $apiKey,
            ],
        ]);

        return $response->toArray();
    }
}