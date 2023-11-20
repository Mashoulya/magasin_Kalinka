<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function search(ProductRepository $productRepository, Request $request): Response
    {
        $searchData = new SearchData();
        $searchForm = $this->createForm(SearchType::class, $searchData);

        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $searchData->page = $request->query->getInt('page', 1);
            $products = $productRepository->findBySearch($searchData);

            if (empty($products)) {
                $this->addFlash('warning', 'Aucun résultat trouvé pour votre recherche.');
            }

            return $this->render('product/search_results.html.twig', [
                'searchForm' => $searchForm->createView(),
                'products' => $products,
            ]);
        }

        return $this->render('product/search_form.html.twig', [
            'searchForm' => $searchForm->createView(),
        ]);
    }
}
