<?php

    #Commence toujours par App puis le répertoire dans lequel le fichier se trouve
namespace App\Controller;

    #alias pour le chemin appelé dans la ligne du commentaire interprété
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #Commentaire interprété, les 2 * sont importantes.
    /**
     * @Route("/")
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }
}