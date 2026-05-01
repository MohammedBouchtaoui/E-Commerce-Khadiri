<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategoryRepository $categoryRepo): Response
    {
        return $this->render('category/browse_categories.html.twig', [
            'categories' => $categoryRepo->findAll(),
        ]);
    }

    #[Route('/categories', name: 'app_categories')]
    public function categories(CategoryRepository $categoryRepo): Response
    {
        return $this->render('category/browse_categories.html.twig', [
            'categories' => $categoryRepo->findAll(),
        ]);
    }

    #[Route('/products', name: 'app_products')]
    public function products(ProductRepository $productRepo): Response
    {
        return $this->render('product/indew.html.twig', [
            'products' => $productRepo->findAll(),
        ]);
    }

    #[Route('/category/{slug}', name: 'app_products_by_category')]
    public function productsByCategory(string $slug, CategoryRepository $categoryRepo, ProductRepository $productRepo): Response
    {
        $category = $categoryRepo->findOneBy(['slug' => $slug]);

        if (!$category) {
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        return $this->render('product/products_by_category.html.twig', [
            'category' => $category,
            'products' => $productRepo->findBy(['category' => $category]),
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_details')]
    public function product(int $id, ProductRepository $productRepo): Response
    {
        $product = $productRepo->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        return $this->render('product/product_details.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/cart', name: 'app_cart')]
    public function cart(): Response
    {
        return $this->render('cart/cart.html.twig');
    }

    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('profile/profile.html.twig');
    }

    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }
}