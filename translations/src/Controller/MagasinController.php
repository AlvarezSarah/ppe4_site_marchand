<?php

namespace App\Controller;

use App\Entity\Magasin;
use App\Entity\MagasinSearch;
use App\Entity\Produit;
use App\Entity\ProduitSearch;
use App\Form\MagasinSearchType;
use App\Form\ProduitSearchType;
use App\Form\ProduitType;
use App\Repository\MagasinRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


class MagasinController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */

    private $em;


    /**
     * @var MagasinRepository
     */

    private $Mrepository;

    public function __construct(MagasinRepository $Mrepository, EntityManagerInterface $em)
    {
        $this->Mrepository = $Mrepository;
        $this->em = $em;
    }

    /**
     * @Route("/magasins", name="trintar.magasin", methods={"GET"})
     * @param MagasinRepository $Mrepository
     * @return Response
     */
    public function index(PaginatorInterface $paginator,MagasinRepository $Mrepository, Request $request): Response
    {
        $search = new MagasinSearch();
        $form = $this->createForm(MagasinSearchType::class, $search);
        $form->handleRequest($request);

        $magasin = $paginator->paginate(
            $this->Mrepository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('trintar/magasin.html.twig', [
            'current_menu' => 'magasins',
            'magasins' => $magasin,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/magasins/{slug}-{id}", name="magasin.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     * @param Magasin $magasin
     */

    public function show(Magasin $magasin, string $slug): Response
    {
        if ($magasin->getSlug() !== $slug){
            return $this->redirectToRoute('magasin.show', [
                'id' => $magasin->getId(),
                'slug' => $magasin->getSlug()
            ], 301);
        }
        return $this->render('trintar/showMagasin.html.twig', [
            'magasin' => $magasin,
            'current_menu' => 'magasins'
        ]);

    }
}
