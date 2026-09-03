<?php

namespace App\Controller;

use App\Dto\CreateTribeDto;
use App\Entity\Tribe;
use App\Service\TribeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api', name: 'app_tribe')]
final class TribeController extends AbstractController
{
    #[Route('/tribe/create', name: '_create', methods: ['POST'])]
    public function create(
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        TribeService $tribeService,
    ): JsonResponse {
        // /** @var CreateTribeDto $dto */
        $dto = $serializer->deserialize(
            $request->getContent(),
            CreateTribeDto::class,
            'json'
        );

        $errors = $validator->validate($dto);

        if (count($errors) > 0) {
            return new JsonResponse(
                ['errors' => (string) $errors],
                Response::HTTP_BAD_REQUEST
            );
        }

        $tribe = $tribeService->create($dto);

        return new JsonResponse(
            [
                'id' => $tribe->getId(),
                'message' => 'Tribe created',
            ],
            Response::HTTP_CREATED
        );
    }

    #[Route('/tribe/new-code/{tribe}', name: '_new_code', methods: ['PATCH'])]
    public function generateNewInivationCode(
        Tribe $tribe,
        TribeService $tribeService,
        EntityManagerInterface $em,
    ): JsonResponse {
        $code = $tribeService->codeGenerator();
        $tribe->setCode($code);

        $em->persist($tribe);
        $em->flush();

        return new JsonResponse(
            [
                'code' => $tribe->getCode(),
                'message' => 'New code generated',
            ],
            Response::HTTP_CREATED
        );
    }
}
