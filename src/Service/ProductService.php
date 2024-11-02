<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;

class ProductService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function searchProductByArticle(string $article, string $apiKey)
    {
        try {
            // я так и не понял на какой url отправлять запрос ,
            // не понимаю документации вашего поставщика пробовал /search и все перечисленные
            // у него 
            // и поэтому уже не знаю так как никаких адекватных документаций не нашел
            $response = $this->client->request('GET', 'http://api.tmparts.ru/search', [
                'query' => [
                    'Article' => $article,
                    'api_key' => $apiKey,
                ],
            ]);

           
            if ($response->getStatusCode() !== 200) {
                throw new \Exception("Error Response: " . $response->getStatusCode());
            }

            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            
            throw new \Exception("Transport error: " . $e->getMessage());
        } catch (ClientExceptionInterface $e) {
            
            throw new \Exception("Client error: " . $e->getMessage());
        } catch (ServerExceptionInterface $e) {
            
            throw new \Exception("Server error: " . $e->getMessage());
        } catch (\Exception $e) {
           
            throw new \Exception("An error occurred: " . $e->getMessage());
        }
    }
}
