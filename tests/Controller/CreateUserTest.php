<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateUserTest extends WebTestCase
{
  public function test_create_user_post(): void
  {
    $client = static::createClient();

    $client->request(method: 'POST', uri: '/users',
      content: json_encode([
        'firstName' => 'Teste',
        'lastName' => 'Attempt',
        'email' => 'teste@email.com',
        'address' => [
          'street' => 'Avenida Afonso Pena',
          'number' => '1000',
          'complement' => 'Apto 0000',
          'district' => 'Centro',
          'city' => 'Belo Horizonte',
          'state' => 'Minas Gerais'
        ]
      ])
    );

    $statusCode = $client->getResponse()->getStatusCode();
    $this->assertSame(Response::HTTP_CREATED, $statusCode);
  }

  public function test_create_user_with_invalid_data(): void
  {
    $client = static::createClient();

    $client->request(method: 'POST', uri:'/users',
      content: json_encode([
        'firstName' => 'Teste',
        'email' => 'teste@email.com',
      ])
    );

    $statusCode = $client->getResponse()->getStatusCode();
    $this->assertSame(Response::HTTP_BAD_REQUEST, $statusCode);
  }
}