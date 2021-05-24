<?php

namespace App\Controller;

use App\Entity\Youtube;
use App\Form\YouTubeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class YoutubeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $youtube = new Youtube();
        $form = $this->createForm(YouTubeType::class, $youtube);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $youtube = $form->getData();
            $entityManager->persist($youtube);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this->render('youtube/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
