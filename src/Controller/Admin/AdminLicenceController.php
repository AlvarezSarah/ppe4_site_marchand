<?php

namespace App\Controller\Admin;

use App\Entity\Licence;
use App\Form\LicenceType;
use App\Repository\LicenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminLicenceController extends AbstractController
{

    /**
     * @var LicenceRepository
     */

    private $Lrepository;

    /**
     * @var EntityManagerInterface
     */

    private $em;

    public function __construct(EntityManagerInterface $em, LicenceRepository $Lrepository)
    {
        $this->Lrepository = $Lrepository;
        $this->em = $em;
    }

    /**
     * @route("/admin/licence", name = "admin.licence.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function index()
    {
        $licences = $this->Lrepository->findAll();
        return $this->render('admin/licence/index.html.twig', compact('licences'));
    }

    /**
     * @Route("/adminLicence/create", name="admin.licence.new")
     * @param Licence $Licence
     */

    public function new (Request $request)
    {
        $Licence = new Licence();
        $form = $this->createForm(LicenceType::class, $Licence);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($Licence);
            $this->em->flush();
            $this->addFlash('success', 'Bien crée avec succès !');
            return $this->redirectToRoute('admin.licence.index');
        }
        return $this->render('admin/licence/new.html.twig', [
            'Licence' => $Licence,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/adminLicence/{id}", name="admin.licence.edit", methods="GET|POST")
     * @param Licence $Licence
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function edit(Licence $Licence, Request $request)
    {
        $form = $this->createForm(LicenceType::class, $Licence);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès !');
            return $this->redirectToRoute('admin.licence.index');
        }

        return $this->render('admin/licence/edit.html.twig', [
            'Licence' => $Licence,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/adminLicence/{id}", name="admin.licence.delete", methods="DELETE")
     * @param Licence $Licence
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function delete(Licence $Licence, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $Licence->getId(), $request->get('_token'))){
            $this->em->remove($Licence);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès !');
        }
        return $this->redirectToRoute('admin.licence.index');
    }
}

