<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'categories_list')]
    public function list(CategoryRepository $categories): Response
    {
        // Récupérer toutes mes catégories
        // Puis les envoyer à la vue pour un rendu
        $categories = $categories->findAll();
        // dd($categories);

        return $this->render(
            'category/list.html.twig',
            ['categories' => $categories]
        );
    }

    #[Route('/category/{id}', name: 'category_item')]
    public function item(Category $category): Response
    {
        return $this->render(
            'category/item.html.twig',
            ['category' => $category]
        );
    }
}
