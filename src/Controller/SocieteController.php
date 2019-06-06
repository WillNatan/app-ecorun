<?php

namespace App\Controller;

use App\Entity\Societe;
use App\Form\SocieteType;
use App\Repository\SocieteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @Route("/societe")
 */
class SocieteController extends AbstractController
{
    /**
     * @Route("/", name="societe_index", methods={"GET"})
     */
    public function index(SocieteRepository $societeRepository): Response
    {
        return $this->render('societe/index.html.twig', [
            'societes' => $societeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="societe_new", methods={"GET","POST"})
     */
    public function new(Request $request, SocieteRepository $societeRepository): Response
    {
        if(empty($societeRepository)){
            return $this->redirectToRoute('societe_index');
        }else{
            $societe = new Societe();
            $form = $this->createForm(SocieteType::class, $societe);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                // $file stores the uploaded PDF file
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                $file = $societe->getLogo();

                $fileName = $file->getClientOriginalName().'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('brochures_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochure' property to store the PDF file name
                // instead of its contents
                $societe->setLogo($fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($societe);
                $entityManager->flush();

                return $this->redirectToRoute('societe_index');
            }

            return $this->render('societe/new.html.twig', [
                'societe' => $societe,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}", name="societe_show", methods={"GET"})
     */
    public function show(Societe $societe): Response
    {
        return $this->render('societe/show.html.twig', [
            'societe' => $societe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="societe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Societe $societe): Response
    {
        $currImg = $societe->getLogo();
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);

        if(is_null($societe->getLogo()) and !is_null($currImg)){
            $societe->setLogo($currImg);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            if($societe->getLogo() != $currImg) {
                // Generate a unique name for the file before saving it
                $fileName = $societe->getLogo()->getClientOriginalName();

                // Move the file to the directory where brochures are stored
                $societe->getLogo()->move(
                    $this->getParameter('brochures_directory'),
                    $fileName

                );
                // Update the 'brochure' property to store the PDF file name
                // instead of its contents
                $societe->setLogo($fileName);


                $fs = new Filesystem();


                $pathImage = $this->getParameter('brochures_directory') . '/' . $societe->getLogo();
                if ($fs->exists($pathImage)) {
                    $fs->remove($pathImage);
                }
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('societe_index', [
                'id' => $societe->getId(),
            ]);
        }

        return $this->render('societe/edit.html.twig', [
            'societe' => $societe,
            'form' => $form->createView(),
            'currlogo'=>$currImg
        ]);
    }

    /**
     * @Route("/{id}", name="societe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Societe $societe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$societe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($societe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('societe_index');
    }
}
