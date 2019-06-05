<?php

namespace App\Controller;

use App\Entity\Attributes;
use App\Entity\Devis;
use App\Entity\ProductForm;
use App\Entity\SelectBox;
use App\Form\DevisType;
use App\Repository\CategoriesRepository;
use App\Repository\CommentairesRepository;
use App\Repository\DevisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/devis")
 */
class DevisController extends AbstractController
{
    /**
     * @Route("/", name="devis_index", methods={"GET"})
     */
    public function index(DevisRepository $devisRepository): Response
    {
        return $this->render('devis/index.html.twig', [
            'devis' => $devisRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="devis_new", methods={"GET","POST"})
     */
    public function new(Request $request, DevisRepository $devisRepository ): Response
    {
        $devi = new Devis();
        $pdts = new ProductForm();
        $devi->addProductForm($pdts);
        $entityManager = $this->getDoctrine()->getManager();
        $originalTags = new ArrayCollection();


        foreach ($devi->getProductForms() as $pdt){
            $originalTags->add($pdt);
        }


        if(empty($devisRepository->findAll())){
            $devi->setNumDevis(date('mYd'). 0);
        }
        else{
            $lastDevis = $devisRepository->findOneBy([],['numDevis'=>'DESC'])->getNumDevis();
            $devi->setNumDevis(
                $lastDevis+1
            );
        }
        $form = $this->createForm(DevisType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach($originalTags as $pdt){
                if($devi->getProductForms()->contains($pdt) === false){
                    $entityManager->remove($pdt);
                }
            }

            $devi->setDateCrea(new \DateTime());
            $devi->setDateValid(new \DateTime('+1 month'));
            $entityManager->persist($devi);
            $entityManager->persist($pdts);
            $entityManager->flush();

            return $this->redirectToRoute('devis_index');
        }

        return $this->render('devis/new.html.twig', [
            'devi' => $devi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="devis_show", methods={"GET"})
     */
    public function show(Devis $devi, Request $request): Response
    {


        return $this->render('devis/show.html.twig', [
            'devi' => $devi
        ]);
    }

    /**
     * @Route("/{id}/edit", name="devis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Devis $devi): Response
    {
        $form = $this->createForm(DevisType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devis_index', [
                'id' => $devi->getId(),
            ]);
        }

        return $this->render('devis/edit.html.twig', [
            'devi' => $devi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="devis_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Devis $devi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($devi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('devis_index');
    }
}
