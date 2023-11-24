<?php
 
namespace App\Controller;
 
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 
class HomepageController extends AbstractController
{
    /*
        requête HTTP:
            - contenue dans une classe RequestStack
            - injection de dépendances : accéder à une classe dans une autre classe
            - dans symfony, l'injection de dépendances se fait par le constructeur
    */
 
    public function __construct(private RequestStack $requestStack)
    {
    }
 
    #[Route('/', name: 'homepage.index')]
    public function index(): Response
    {
        /*
            débogage :
                dump : afficher la donnée dans la page
                dd (dump and die) : afficher la donnée puis stopper le script
            getMainRequest : requête HTTP exécutée par le PHP
            propriété de la requête
                - request : $_POST
                - query : $_GET
        */
 
        // récupération d'une donnée envoyée en $_POST
        // $post = $this->requestStack->getMainRequest()->request->get('key');
 
        // dd($post);
 
        // return new Response('{ "key" : "value" }', Response::HTTP_CREATED, [
        //  'Content-Type' => 'application/json'
        // ]);
 
 
        // render : appel d'une vue twig
        // la clé du array associatif devient une variable dans twig
        return $this->render('homepage/index.html.twig', [
            'my_array' => ['value0', 'value1', 'value2'],
            'assoc_array' => [
                'key0' => 'value0',
                'key1' => 'value1',
                'key2' => 'value2',
            ],
            'now' => new \DateTime(),
        ]);
    }

    #[Route('/hello/{name}', name:'homepage.hello')]
    public function hello(string $name): Response
    {
/*         return new Response("hello $name");
 */        return $this->render('homepage/hello.html.twig', [
                'name'=> $name,
            ]);
    }
}