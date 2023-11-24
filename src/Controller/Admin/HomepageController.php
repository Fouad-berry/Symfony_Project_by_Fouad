<?php
 
namespace App\Controller\Admin;
 
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//prefixe des routes du controller
#[Route('/admin')]
class HomepageController extends AbstractController
{ 
    
    #[Route('/', name: 'admin.homepage.index')]
    public function index(): Response
    {
 
        // render : appel d'une vue twig
        // la clé du array associatif devient une variable dans twig
        return $this->render('admin/homepage/index.html.twig');
           
    }
}