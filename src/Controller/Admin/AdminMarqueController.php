<?php

namespace App\Controller\Admin;

use App\Entity\Marque;
use App\Form\MarqueType;
use App\Repository\MarqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMarqueController extends AbstractController
{

    /**
     * @var MarqueRepository
     */

    private $Mrepository;

    /**
     * @var EntityManagerInterface
     */

    private $em;

    public function __construct(EntityManagerInterface $em, MarqueRepository $Mrepository)
    {
        $this->Mrepository = $Mrepository;
        $this->em = $em;
    }

    /**
     * @route("/admin/marque", name = "admin.marque.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function index()
    {
        $marques = $this->Mrepository->findAll();
        return $this->render('admin/marque/index.html.twig', compact('marques'));
    }

    /**
     * @Route("/adminMarque/create", name="admin.marque.new")
     * @param Marque $Marque
     */

    public function new (Request $request)
    {
        $Marque = new Marque();
        $form = $this->createForm(MarqueType::class, $Marque);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($Marque);
            $this->em->flush();
            $this->addFlash('success', 'Bien crée avec succès !');
            return $this->redirectToRoute('admin.marque.index');
        }
        return $this->render('admin/marque/new.html.twig', [
            'Marque' => $Marque,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/adminMarque/{id}", name="admin.marque.edit", methods="GET|POST")
     * @param Marque $Marque
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function edit(Marque $Marque, Request $request)
    {
        $form = $this->createForm(MarqueType::class, $Marque);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès !');
            return $this->redirectToRoute('admin.marque.index');
        }

        return $this->render('admin/marque/edit.html.twig', [
            'Marque' => $Marque,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/adminMarque/{id}", name="admin.marque.delete", methods="DELETE")
     * @param Marque $Marque
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function delete(Marque $Marque, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $Marque->getId(), $request->get('_token'))){
            $this->em->remove($Marque);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès !');
        }
        return $this->redirectToRoute('admin.marque.index');
    }
}

