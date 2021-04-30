<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateUserTest extends WebTestCase
{
  public function test_create_user(): void
  {
    $client = static::createClient();

    $client->request(method: 'POST', uri: '/users/1/phones',
      content: json_encode([
        'areaCode' => 31,
        'phoneNumber' => '99999999'
      ])
    );

    $statusCode = $client->getResponse()->getStatusCode();
    $this->assertSame(Response::HTTP_CREATED, $statusCode);
  }

  public function test_get_user_create_user_phone_should_return_400(): void
  {
    $client = static::createClient();

    $client->request(method: 'POST', uri: '/users/999/phones');

    $statusCode = $client->getResponse()->getStatusCode();
    $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
  }

  public function test_create_user_phone_with_invalid_data(): void
  {
    $client = static::createClient();

    $client->request(method: 'POST', uri:'/users/1/phones',
      content: json_encode([
        'areaCode' => 31
      ])
    );

    $statusCode = $client->getResponse()->getStatusCode();
    $this->assertSame(Response::HTTP_BAD_REQUEST, $statusCode);
  }
}