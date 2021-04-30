<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserTest extends WebTestCase
{
  public function test_delete_user_should_no_content(): void
  {
    $client = static::createClient();

    $client->request(method: 'DELETE', uri: '/users/1');

    $statusCode = $client->getResponse()->getStatusCode();
    $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
  }

  public function test_delete_user_should_return_400(): void
  {
    $client = static::createClient();

    $client->request(method: 'DELETE', uri: '/users/999');

    $statusCode = $client->getResponse()->getStatusCode();
    $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
  }

  
}