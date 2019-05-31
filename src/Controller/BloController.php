<?php

namespace App\Controller;

use App\Entity\Blo;
use App\Form\BloType;
use App\Repository\BloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blo")
 */
class BloController extends AbstractController
{
    /**
     * @Route("/", name="blo_index", methods={"GET"})
     */
    public function index(BloRepository $bloRepository): Response
    {
        return $this->render('blo/index.html.twig', [
            'blos' => $bloRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="blo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $blo = new Blo();
        $form = $this->createForm(BloType::class, $blo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blo);
            $entityManager->flush();

            return $this->redirectToRoute('blo_index');
        }

        return $this->render('blo/new.html.twig', [
            'blo' => $blo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blo_show", methods={"GET"})
     */
    public function show(Blo $blo): Response
    {
        return $this->render('blo/show.html.twig', [
            'blo' => $blo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="blo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Blo $blo): Response
    {
        $form = $this->createForm(BloType::class, $blo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blo_index', [
                'id' => $blo->getId(),
            ]);
        }

        return $this->render('blo/edit.html.twig', [
            'blo' => $blo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Blo $blo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blo_index');
    }
}
