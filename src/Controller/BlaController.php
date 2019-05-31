<?php

namespace App\Controller;

use App\Entity\Bla;
use App\Form\BlaType;
use App\Repository\BlaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bla")
 */
class BlaController extends AbstractController
{
    /**
     * @Route("/", name="bla_index", methods={"GET"})
     */
    public function index(BlaRepository $blaRepository): Response
    {
        return $this->render('bla/index.html.twig', [
            'blas' => $blaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bla_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bla = new Bla();
        $form = $this->createForm(BlaType::class, $bla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bla);
            $entityManager->flush();

            return $this->redirectToRoute('bla_index');
        }

        return $this->render('bla/new.html.twig', [
            'bla' => $bla,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bla_show", methods={"GET"})
     */
    public function show(Bla $bla): Response
    {
        return $this->render('bla/show.html.twig', [
            'bla' => $bla,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bla_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bla $bla): Response
    {
        $form = $this->createForm(BlaType::class, $bla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bla_index', [
                'id' => $bla->getId(),
            ]);
        }

        return $this->render('bla/edit.html.twig', [
            'bla' => $bla,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bla_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bla $bla): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bla->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bla);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bla_index');
    }
}
