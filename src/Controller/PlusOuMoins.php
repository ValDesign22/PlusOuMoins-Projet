<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PlusOuMoins extends AbstractController
{
    private int $configMin;
    private int $configMax;
    private int $configEssais;

    public function __construct(int $min, int $max, int $essais)
    {
        $this->configMin = $min;
        $this->configMax = $max;
        $this->configEssais = $essais;
    }

    /**
     * @Route("/", name="plusoumoins_jouer")
     */
    public function jouer(SessionInterface $session, Request $request): Response
    {
        if (
            !$session->has("Nombre à deviner") &&
            !$session->has("Essais")
        ) {
            $this->initSession($session, $this->configMin, $this->configMax, $this->configEssais);
        }

        $essais = (int)$session->get("Essais");

        if ($essais === 0) {
            $error = "Vos essais sont à zéro.";
            $this->initSession($session, $this->configMin, $this->configMax, $this->configEssais);
        } elseif ($request->request->has("nombre")) {
            $nombreUtilisateur = (int)$request->request->get("nombre");
            $nombreADeviner = (int)$session->get("Nombre à deviner");

            switch ($nombreUtilisateur <=> $nombreADeviner) {
                case -1:
                    $error = "Le nombre est trop petit.";
                    $session->set("Essais", --$essais);
                    break;
                case 1:
                    $error = "Le nombre est trop grand.";
                    $session->set("Essais", --$essais);
                    break;
                case 0:
                    $success = "Le nombre est bon.";
                    $this->initSession($session, $this->configMin, $this->configMax, $this->configEssais);
            }
        }

        return $this->render("plusoumoins.html.twig", [
            "essais" => $essais,
            "error" => $error ?? null,
            "success" => $success ?? null,
            "min" => $this->configMin,
            "max" => $this->configMax,
            "precedent" => $nombreUtilisateur ?? 0
        ]);
    }

    /**
     * @Route("/reinitialiser", name="plusoumoins_reinitialiser")
     */
    public function reinitialiser(SessionInterface $session): Response
    {
        $this->initSession($session, $this->configMin, $this->configMax, $this->configEssais);
        return $this->redirectToRoute("plusoumoins_jouer");
    }

    public function initSession(SessionInterface $session, int $min, int $max, int $essais): void
    {
        $session->set("Nombre à deviner", random_int($min, $max));
        $session->set("Essais", $essais);
    }
}
