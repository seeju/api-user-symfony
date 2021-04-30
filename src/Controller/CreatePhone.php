<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Phone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreatePhone
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    )
    {
    }

    #[Route("/users/{id}/phones", methods: ["POST"])]
    public function __invoke(int $id, Request $request): Response
    {
        $user = $this->entityManager->find(User::class, $id);

        if(!$user){
            return new JsonResponse([
              'error' => 'Usuario nao encontrado'
            ], Response::HTTP_NOT_FOUND);
          }

        $phone = $this->serializer->deserialize($request->getContent(), Phone::class, 'json');

        $error = $this->validator->validate($phone);

        if(count($error)>0) {
            $violations = array_map(function(ConstraintViolationInterface $violation) {
                return [
                    'path' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage(),
                ];
            }, iterator_to_array($error)
        );

        $response = [
            'error' => 'Informacoes invalidas',
            'violations' => $violations,
        ];

        return new JsonResponse($response, Response::HTTP_BAD_REQUEST);

        }

        $phone->setUser($user);
        $user->addPhoneNumber($phone);
    
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    
        return new JsonResponse([
          'status' => 'ok',
          'id' => $phone->getId()
        ], Response::HTTP_CREATED); 
      }
    }

        