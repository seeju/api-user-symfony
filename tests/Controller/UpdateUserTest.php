<?php

namespace App\Test\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UpadteUserTest extends WebTestCase
{
  private EntityManagerInterface $em;
  private KernelBrowser $client;

  protected function setUp(): void
  {
    $this->client = self::createClient();

    $this->em = self::$kernel->getContainer()->get('doctrine')->getManager();
    $tool = new SchemaTool($this->em);

    $metadata = $this->em->getClassMetadata(User::class);
    $tool->dropSchema([$metadata]);

    try{
      $tool->createSchema([$metadata]);
    }catch(ToolsException $e){
      $this->fail('Impossivel criar schema da entidade User: "'.$e->getMessage().'"');
    }
  }

  public function test_update_user_should_no_content(): void
  {
    $user = new User();
    $user->setFirstName('Teste');
    $user->setLastName('Funcional');
    $user->setEmail('email@teste.funcional');

    $this->em->persist($user);
    $this->em->flush();

    $this->client->request(method: 'PUT', uri: '/users/1', content: json_encode([
      'firstName' => 'Teste',
      'lastName' => 'Attept',
      'email' => 'teste@email.com',
    ]));

    $statusCode = $this->client->getResponse()->getStatusCode();
    $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
  }

  public function test_update_user_should_return_400(): void
  {
    $this->client->request(method: 'PUT', uri: '/users/999', content: json_encode([
      'firstName' => 'Teste',
      'lastName' => 'Attempt',
      'email' => 'teste@email.com',
    ]));

    $statusCode = $this->client->getResponse()->getStatusCode();
    $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
  }
}