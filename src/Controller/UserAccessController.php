<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Service\FileUploader;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserAccessController extends AbstractController
{
    #[Route('/', name: 'app_user_access')]
    public function index(): Response
    {
        return $this->render('user_access/index.html.twig', [
            'controller_name' => 'UserAccessController',

        ]);
    }

    #[Route('/edit', name: 'app_user_access_edit')]
    public function edit(UserRepository $userRepository, Request $request, FileUploader $fileUploader): Response
    {
        
        $user = $this->getUser();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture = $form->get('picture')->getData();
            if ($picture) {
                $pictureName = $fileUploader->upload($picture);
                $user->setPicture($pictureName);
            }

            $userRepository->save($user, true);
            return $this->redirectToRoute('app_user_access', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_access/editprofile.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/delete', name: 'app_user_access_delete', methods: ['POST'])]
    public function delete(User $user, ManagerRegistry $doctrine ): Response
    {
        $user = $this->getUser();

        $em = $doctrine()->getManager();
        $user = $em->getRepository('App:User')->find($user);
        $em->remove($user);
        
        $em->flush();
        $this->addFlash(
            'notice',
            'Account Deleted'
        );

        return $this->redirectToRoute('app_logout', [], Response::HTTP_SEE_OTHER);
    }
}