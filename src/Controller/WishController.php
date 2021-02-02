<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishFormType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/list/", name="wish_list", methods={"GET"})
     */
    public function list(WishRepository $wishRepository)
    {
        $wishes = $wishRepository->findBy(["isPublished"=>true],["dateCreated" =>"DESC"]);

        return $this->render('wish/list.html.twig', ["wishes"=> $wishes]);
    }

    /**
     * @Route("/detail/{id}", name="wish_detail", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function detail(WishRepository $wishRepository, $id)
    {
        $wishSelect = $wishRepository->find($id);

        if (!$wishSelect) {
            //déclencher une 404
            throw $this->createNotFoundException('This wish is gone.');

        }

        return $this->render('wish/detail.html.twig', ["wishSelect"=>$wishSelect]);
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

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/add", name="wish_add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager)
    {
        /* GENERER DES VALEURS ALEATOIRES SUR LE FORMULAIRE

        $faker = \Faker\Factory::create("fr_FR");
        $bidon = new Wish();
        $bidon->setTitle($faker->jobTitle);
        $bidon->setDescription($faker->paragraph(5));
        $bidon->setAuthor($faker->name);
        */

        $wish = new Wish();
        $user = $this->getUser();
        $wish->setAuthor($user->getPseudo());
        #Ajouter $bidon en paramètre pour générer les valeurs aléatoires
        $form = $this->createForm(WishFormType::class, $wish);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $wish->setDateCreated(new \DateTime());
            $wish->setIsPublished(true);

            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success', 'Nouvelle idée ajoutée !');

            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }

        return $this->render('wish/add.html.twig',
            ["wish_form" => $form->createView()]);

    }



}
