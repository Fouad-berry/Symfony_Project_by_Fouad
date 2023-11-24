<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\ByteString;

class ContactController extends AbstractController
{
    public function __construct(private ProductRepository $productRepository, private RequestStack $requestStack, private EntityManagerInterface $entityManager)
    {
        
    }


    #[Route('/contact', name:'contact.form')]
    public function form(int $id = null): Response
    {
        #creation d'un formulaire
        $entity = $id ? $this->productRepository->find($id) : new Contact();
        $type = ContactType::class;
        
/*         dd($entity);
 */
        $form = $this->createForm($type, $entity);

        //recuperer la saisie précédente dans la requete http
        $form->handleRequest($this->requestStack->getMainRequest());

        //si le formulaire est valide et soumis
        if($form->isSubmitted() && $form->isValid()){
            //gestion de l'image
            //ByteSprint permet de generer une chaine de caractères aléatoire
            $filename = ByteString::fromRandom(32)->lower();

/*             dd($filename, $entity); 
 */         $this->entityManager->persist($entity);
            $this->entityManager->flush();


            //Message flash : message stocké en session supprimé suite a son affichage
            $this->addFlash('notice', 'Message send success');

            //redirection vers la page d'accueil de l'admin
            return $this->redirectToRoute('contact.form');

        }

        return $this->render('contact/form.html.twig', ['form' => $form->createView(),
        ]);
    }


}
