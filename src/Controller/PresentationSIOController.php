<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Inscription;
use App\Entity\Bac;
use Symfony\Component\Validator\Constraints\NotBlank;


class PresentationSIOController extends AbstractController
{
    /**
     * @Route("/BTSSIO", name="premiere_page")
     */
       
    public function index(): Response
    {
        return $this->render('premiere_page/index.html.twig'
            
        );
    }
    
    /**
     * @Route("/BTSSIO/pagebienvenue", name="deuxieme_page")
     */
    
    public function Bienvenue(): Response
    {
        return $this->render('deuxieme_page/bienvenue.html.twig'
            
        );
    }
    
    /**
     * @Route("/BTSSIO/accueil", name="accueil")
     */
    
    public function accueil(): Response
    {
        return $this->render('troisieme_page/accueil.html.twig'
            
        );
    }
    
    /**
     * @Route("/BTSSIO/presentation", name="presentation")
     */
    
    public function presentation(): Response
    {
        return $this->render('quatrieme_page/presentation.html.twig'
            
        );
    }
    
    /**
     * @Route("/BTSSIO/specialites", name="specialite")
     */
    
    public function specialites(): Response
    {
        return $this->render('cinquieme_page/specialites.html.twig'
            
        );
    }
    
    /**
    *@Route("BTSSIO/creation/inscription", name="ajoutInscription")
    **/
    public function ajout(Request $request, EntityManagerInterface $manager): Response
    {
        $uneInscription = new Inscription();
        $leform = $this->createForm(\App\Form\InscriptionType::class,
        $uneInscription);
        $leform->handleRequest($request);
        if ($leform->isSubmitted() && $leform->isValid()) {
        $lobjetInscription = $leform->getData();
        $manager->persist($lobjetInscription);
        $manager->flush();
        return $this -> redirectToRoute ( 'accueil' );
        }
        return $this->render('inscription/ajout.html.twig', [
        'leformulaireInscription' => $leform->createView()]) ;
    }
    
    /**
    *@Route("BTSSIO/creation/inscription/liste", name="listeInscription")
    **/
    public function listeInscription(): Response 
    {        
        
            $repo = $this->getDoctrine()->getRepository(\App\Entity\Inscription::class);
            $lesInscriptions = $repo->findAll();
            $lesInscriptionsById = $repo->find(1);
            return $this->render('inscription/listeInscription.html.twig',
                    [
                        'controller_name' => 'PresentationSIOController',
                        'listeInscription' => $lesInscriptions,
                        'listeInscriptionById' => $lesInscriptionsById,
                        ]
                    );        
    }
    
    /**
    *@Route("BTSSIO/creation/inscription/recherche/id/{id}", name="rechercheInscriptionById")
    **/
    public function inscriptionById($id = null): Response 
    {        
        
            $repo = $this->getDoctrine()->getRepository(\App\Entity\Inscription::class);
            $lesInscriptionsById = $repo->findOneByid($id);
            return $this->render('inscription/rechercheInscriptionById.html.twig',
                    [
                        'controller_name' => 'PresentationSIOController',
                        'listeInscriptionById' => $lesInscriptionsById,
                        ]
                    );        
    }
    
    /**
    *@Route("BTSSIO/creation/inscription/recherche/prenom/{prenom}", name="rechercheInscriptionByName")
    **/
    public function inscriptionByName($prenom = null): Response 
    {        
        
            $repo = $this->getDoctrine()->getRepository(\App\Entity\Inscription::class);
            $lesInscriptionsByName = $repo->findOneByprenom($prenom);
            return $this->render('inscription/rechercheInscriptionByName.html.twig',
                    [
                        'controller_name' => 'PresentationSIOController',
                        'listeInscriptionByName' => $lesInscriptionsByName,
                        ]
                    );        
    }
}
