<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Test extends AbstractController
{
    /**
     * @Route("/test")
     */
    public function execute()
    {
        return $this->render("test.html.twig");
    }
}
