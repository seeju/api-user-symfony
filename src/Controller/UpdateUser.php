<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateUser
{
    public function __construct(private EntityManagerInterface $entityManager, private ValidatorInterface $validator, private SerializerInterface $serializer)
    {
    }

    #[Route("/users/{id}", methods: ["PUT"])]
    public function __invoke(int $id, Request $request): Response
    {
        $requestContent = $this->serializer->deserialize($request->getContent(), User::class,  format: 'json');
        $user = $this->entityManager->find(User::class, $id);

        if (null === $user) {
            return new JsonResponse([
                'error' => 'Usuario nao encontrado'
            ], Response::HTTP_NOT_FOUND);
        }

        $errors = $this->validator->validate($requestContent);

        if(count($errors) > 0){
          $violations = array_map(function(ConstraintViolationInterface $violation){
            return [
              'path' => $violation->getPropertyPath(),
              'message' => $violation->getMessage(),
            ];
          }, iterator_to_array($errors));
    
          $response = [
            'error' => 'Informacoes invalidas',
            'violations' => $violations,
          ];
    
          return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        $user->setfirstName($requestContent->getfirstName());
        $user->setlastName($requestContent->getlastName());
        $user->setemail($requestContent->getemail());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse([
            'status' => 'Usuario alterado'
        ], Response::HTTP_ACCEPTED);
    }
}
