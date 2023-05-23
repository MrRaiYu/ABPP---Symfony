<?php
    namespace App\Controller;
    use Doctrine\Persistence\ManagerRegistry;
    use App\Formulaire\EntrepriseForm;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use App\Entity\Entreprise;
use App\Formulaire\RechercheEntreprise;
use Doctrine\DBAL\Query;
use Symfony\Component\HttpFoundation\Request;

    class EntrepriseController extends AbstractController {

        /**
        *@Route("listeEntreprises", name="listeEntreprises")
        */

        function listeEntreprises(Request $requestHTTP,ManagerRegistry $doctrine) {
            
            $entityManager = $doctrine->getManager();
            $listeentreprises = $entityManager->getRepository(Entreprise::class)->findAll();

            $formulaireSearch = $this->createForm(RechercheEntreprise :: class);
            $formulaireSearch->handleRequest($requestHTTP);
            if ($formulaireSearch->isSubmitted() && $formulaireSearch->isValid())
            {
                $nom = $formulaireSearch['Nom']->getData();
                $adresse = $formulaireSearch['Adresse']->getData();
                $ville = $formulaireSearch['Ville']->getData();
                
                //$listeentreprises = $doctrine->getRepository(Entreprise::class)->findBy(['EntRS' => '%' . $nom . '%']) OR $listeentreprises = $doctrine->getRepository(Entreprise::class)->findBy(['Adresse' => '%' . $adresse . '%']) OR $listeentreprises = $doctrine->getRepository(Entreprise::class)->findBy(['EntVille' => '%' . $ville . '%']);
                $listeentreprises = $entityManager->getRepository(Entreprise::class)->RechercheEntreprise($nom,$ville,$adresse);
                if ($listeentreprises==null)
                {
                    $this->addFlash('error', 'Aucune entreprise ne correspond à ces critères');
                }
                return $this->render('listeentreprises.html.twig' ,['listeentreprises'=> $listeentreprises, 'formulaireSearch' => $formulaireSearch->createView()]);
            }
            else
            {
                return $this->render('listeentreprises.html.twig' ,['listeentreprises'=> $listeentreprises, 'formulaireSearch' => $formulaireSearch->createView()]);
            }
        }  
        
        /**
        *@Route("DetailEntreprise/{id}", name="DetailEntreprise")
        */

        function DetailEntreprise($id, ManagerRegistry $doctrine) {

             
            $entityManager = $doctrine->getManager();
            $listeentreprises = $doctrine->getRepository(Entreprise::class)->find($id);
            return $this->render('DetailEntreprise.html.twig', ['entreprise' => $listeentreprises]);          
        }

        /**
        *@Route("SupprimerEntreprise/{id}", name="SupprimerEntreprise")
        */
        
        function SupprimerEntreprise($id, ManagerRegistry $doctrine) {
            $entityManager = $doctrine->getManager();
            $listeentreprises = $doctrine->getRepository(Entreprise::class)->find($id);
            $entityManager->remove($listeentreprises);
            $entityManager->flush($listeentreprises);
            return $this->redirectToRoute("listeEntreprises");       
        }

       /**
        *@Route("ModifierEntreprise/{id}", name="ModifierEntreprise")
        */

        function ModifierEntreprise($id,Request $requestHTTP,ManagerRegistry $doctrine) {

            $listeentreprises = $doctrine->getRepository(Entreprise::class)->find($id);

            $formulaireEntreprise = $this->createForm(EntrepriseForm :: class, $listeentreprises);
    
            $formulaireEntreprise->handleRequest($requestHTTP);


            if ($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid()) 
            {

                $EntrepriseInfos = $formulaireEntreprise->getData();
    
                 $entityManager = $doctrine->getManager();
                    
                $entityManager->persist($EntrepriseInfos);
               
                $entityManager->flush();
                    
                return $this->redirectToRoute('listeEntreprises');
            }
            else
            {
                return $this->render('entrepriseform.html.twig' ,['entrepriseform' => $formulaireEntreprise->createView()]);
            }
        }

        /**
        *@Route("AjouterEntreprise", name="AjouterEntreprise")
        */

        function AjouterEntreprise(Request $requestHTTP,ManagerRegistry $doctrine) {

            $listeentreprises = new Entreprise();

            $formulaireEntreprise = $this->createForm(EntrepriseForm :: class, $listeentreprises);
    
            $formulaireEntreprise->handleRequest($requestHTTP);


            if ($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid()) 
            {

                $EntrepriseInfos = $formulaireEntreprise->getData();
    
                 $entityManager = $doctrine->getManager();
                    
                $entityManager->persist($EntrepriseInfos);
               
                $entityManager->flush();
                    
                return $this->redirectToRoute('listeEntreprises');
            }
            else
            {
                return $this->render('entrepriseform.html.twig' ,['entrepriseform' => $formulaireEntreprise->createView()]);
            }
        }
    }     
?>
