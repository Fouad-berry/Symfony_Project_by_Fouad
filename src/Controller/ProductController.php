<?php 

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(private ProductRepository $productRepository)
    {
        
    }

    #[Route('/products', name:'product.index')]
    public function index():Response
    {
     //   dd($this->productRepository->findAll());

        return $this->render('product/index.html.twig', [
            'products' => $this->productRepository->findAll(),
        ]);
    }

    #[Route('/products/{id}', name:'product.details')]
    public function details(int $id): Response
    {
/*         dd($this->productRepository->find($id));
 */        return $this->render('product/details.html.twig', [
            'product' => $this->productRepository->find($id),
        ]);
    }

}
