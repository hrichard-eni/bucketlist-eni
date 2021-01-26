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
     * @Route("/", name="main_home")
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route ("/about-us", name="main_aboutus")
     */

    public function aboutus()
    {
        return $this->render('main/aboutus.html.twig');
    }
}