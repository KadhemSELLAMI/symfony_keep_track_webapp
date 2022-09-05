<?php

namespace App\Controller;

use App\Repository\DayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DayController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(DayRepository $dayRepo)
    {
        $days = $dayRepo->findAll();
        //dd($days);
        return $this->render('index.html.twig', [
            "days" => $days
        ]);
    }

    /**
     * @Route("/read/{id}", name="read")
     */
    public function read_one(DayRepository $dayRepo, $id)
    {
        $day = $dayRepo->find($id);

        return $this->render('read_one.html.twig', [
            "day" => $day
        ]);
    }
}
