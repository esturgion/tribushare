<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\BelongService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'app_belong')]
final class BelongController extends AbstractController
{
    #[Route('/belong/add/{user}', name: '_add_user', methods:['POST'])]
    public function addUser(
        User $user,
        Request $request,
        BelongService $belongService,
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $invitationCode = $data['invitationCode'] ?? null;

        if (!$invitationCode) {
            return new JsonResponse(
                [
                    'message' => 'Le code d\'invitation est obligatoire.',
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $belongService->addUserToTribe($user, $invitationCode);
            return new JsonResponse(
                [
                    'message' => 'Utilisateur ajouté à la tribe.',
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return new JsonResponse(
                [
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
