<?php

namespace App\Controller;

use App\Entity\Wish;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/list", name="wish_list")
     */
    public function list()
    {
        return $this->render('wish/list.html.twig');
    }

    /**
     * @Route("/detail/{id}", name="wish_detail", methods={"GET"}, requirements={"id": "[0-9]+"})
     */
    public function detail($id): Response
    {
        return $this->render('wish/detail.html.twig', ["id"=> $id]);
    }

    /**
     * @Route("/test", name="wish_test")
     */
    public function test(EntityManagerInterface $entityManager)
    {
        $wish = new Wish();

        $wish->setTitle('Apprendre le norvégien');
        $wish->setDescription('Apprendre le norvégien, pour écrire des textes de Black Metal');
        $wish->setAuthor('Hugo');
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());

        $entityManager->persist($wish);

        $wish2 = new Wish();

        $wish2->setTitle('Gagner au loto');
        $wish2->setDescription('Un jour, les bons numéros seront miens');
        $wish2->setAuthor('Sigismond');
        $wish2->setIsPublished(true);
        $wish2->setDateCreated(new \DateTime());

        $entityManager->persist($wish2);

        $entityManager->flush();

        return $this->render('wish/test.html.twig');
    }
}
