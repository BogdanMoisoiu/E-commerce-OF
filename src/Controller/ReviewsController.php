<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Reviews;
use App\Form\ReviewsType;
use App\Repository\ProductRepository;
use App\Repository\ReviewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reviews')]
class ReviewsController extends AbstractController
{
    #[Route('/', name: 'app_reviews_index', methods: ['GET'])]
    public function index(ReviewsRepository $reviewsRepository): Response
    {
        return $this->render('reviews/index.html.twig', [
            'reviews' => $reviewsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reviews_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReviewsRepository $reviewsRepository): Response
    {
        $review = new Reviews();
        $form = $this->createForm(ReviewsType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $review->setType('review');
            $reviewsRepository->save($review, true);

            return $this->redirectToRoute('app_user_access', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reviews/new.html.twig', [
            'reviews' => $review,
            'form' => $form,
        ]);
    }
    #[Route('/new/question', name: 'app_reviews_question', methods: ['GET', 'POST'])]
    public function question(Request $request, ReviewsRepository $reviewsRepository): Response
    {
        $review = new Reviews();
        $form = $this->createForm(ReviewsType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $review->setType('question');
            $reviewsRepository->save($review, true);

            return $this->redirectToRoute('app_user_access', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reviews/new.html.twig', [
            'reviews' => $review,
            'form' => $form,
        ]);
    }

    #[Route('/new/answer/{id}', name: 'app_reviews_answer', methods: ['GET', 'POST'])]
    public function answer(Request $request, ReviewsRepository $reviewsRepository): Response
    {
        $review = new Reviews();
        $form = $this->createForm(ReviewsType::class, $review);
        $form->handleRequest($request);

       //get user's email or id, so we write answer for specific question
        if ($form->isSubmitted() && $form->isValid()) {
            $review->setType('answer');
            $reviewsRepository->save($review, true);

            return $this->redirectToRoute('app_user_access', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reviews/new.html.twig', [
            'reviews' => $review,
            'form' => $form,
        ]);
    }
  
    #[Route('/{id}', name: 'app_reviews_show', methods: ['GET'])]
    public function show(Reviews $review, ReviewsRepository $reviewsRepository, $id): Response
    {
        return $this->render('reviews/show.html.twig',
            [
                'review' => $review,
                'product' => $reviewsRepository->findBy(["Fk_product" => $id]),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reviews_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reviews $review, ReviewsRepository $reviewsRepository): Response
    {
        $form = $this->createForm(ReviewsType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reviewsRepository->save($review, true);

            return $this->redirectToRoute('app_reviews_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reviews/edit.html.twig', [
            'review' => $review,
            'form' => $form,
        ]);
    }

    
}
