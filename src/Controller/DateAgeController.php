<?php

namespace App\Controller;

use DateTime;
use App\Form\DateAgeFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DateAgeController extends AbstractController
{
    #[Route('/date_age', name: 'app_date_age')]
    public function calculateAge(Request $request): Response
    {
        $form = $this->createForm(DateAgeFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $date = \DateTime::createFromFormat('Ymd', $data['date']);
            $referenceDate = $data['referenceDate'] ?? new \DateTime();
            $interval = $date->diff($referenceDate);
            $ageInDays = $interval->format('%R%a days');
        } else {
            $ageInDays = null;
        }

        return $this->render('date_age/index.html.twig', [
            'form' => $form->createView(),
            'ageInDays' => $ageInDays,
        ]);
    }
}
