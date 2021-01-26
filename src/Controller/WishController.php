<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/list", name="main_list")
     */
    public function list()
    {
        return $this->render('main/list.html.twig');
    }

    /**
     * @Route("/detail", name="main_detail")
     */
    public function detail()
    {
        return $this->render('main/detail.html.twig');
    }
}
