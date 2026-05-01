<?php
namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        // Il faut ABSOLUMENT envoyer la variable 'categories' au template
        return $this->render('category/browse_categories.html.twig', [
            'categories' => $categoryRepository->findAll(),
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