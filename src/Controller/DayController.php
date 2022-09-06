<?php

namespace App\Controller;

use App\Repository\DayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Day;
use App\Entity\Exercice;
use App\Form\DayType;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

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
    public function read_one(ExerciceRepository $exerciceRepo, DayRepository $dayRepo, $id)
    {
        $day = $dayRepo->find($id);
        $exercices = $exerciceRepo->findDayExercices($id);

        return $this->render('read_one.html.twig', [
            "day" => $day,
            "exercices" => $exercices
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, ManagerRegistry $doctrine)
    {
        $day = new Day();

        $form = $this->createForm(DayType::class, $day);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em = $doctrine->getManager();
            $em->persist($day);
            $em->flush();

            return $this->redirect($this->generateUrl('add_exe'));
        }

        return $this->render('create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/add_exe", name="add_exe")
     */
    public function addExercices(Request $request, ManagerRegistry $doctrine)
    {
        $exercice = new Exercice();

        $form = $this->createForm(ExerciceType::class, $exercice);

        $form->handleRequest($request);

        

        if ($form->isSubmitted()) {

            dd($exercice);

            $em = $doctrine->getManager();
            $em->persist($exercice);
            $em->flush();

            return $this->redirect($this->generateUrl('index'));
        }

        return $this->render('exercice/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(ExerciceRepository $exerciceRepo, DayRepository $dayRepo, ManagerRegistry $doctrine, int $id)
    {
        $day = $dayRepo->find($id);
        $exerciceRepo->removeByDayId($id);
        $em = $doctrine->getManager();
        $em->remove($day);
        $em->flush();

        return $this->redirect($this->generateUrl('index'));
    }
}
