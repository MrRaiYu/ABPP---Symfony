<?php
    namespace App\Controller;
    use Doctrine\Persistence\ManagerRegistry;
    use App\Formulaire\UtilisateurForm;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\Utilisateur;


    class UtilisateurController extends AbstractController {


         /**
        *@Route("AjouterUtilisateur", name="AjouterUtilisateur")
        */
        function AjouterUtilisateur(Request $requestHTTP,ManagerRegistry $doctrine) {

            $utilisateur = new utilisateur();

            $formulaireUtilisateur = $this->createForm(UtilisateurForm :: class, $utilisateur);
    
            $formulaireUtilisateur->handleRequest($requestHTTP);


            if ($formulaireUtilisateur->isSubmitted() && $formulaireUtilisateur->isValid()) 
            {

                    $UtilisateurInfos = $formulaireUtilisateur->getData();
    
                    $entityManager = $doctrine->getManager();
                    
                    $entityManager->persist($UtilisateurInfos);
               
                    $entityManager->flush();
                    
                   return $this->redirectToRoute('listeUtilisateur');
            }

                    else
                    {
                    return $this->render('utilisateurform.html.twig' ,['utilisateurform' => $formulaireUtilisateur->createView()]);
                    }               
        }

        /**
        *@Route("listeUtilisateur", name="listeUtilisateur")
        */

        function listeUtilisateur(Request $requestHTTP,ManagerRegistry $doctrine) {
            
            $entityManager = $doctrine->getManager();
            $listeutilisateur = $entityManager->getRepository(Utilisateur::class)->findAll();

            return $this->render('listeutilisateur.html.twig' ,['listeutilisateur'=> $listeutilisateur]);
        }  
        
        /**
        *@Route("DetailUtilisateur/{id}", name="DetailUtilisateur")
        */

        function DetailUtilisateur($id, ManagerRegistry $doctrine) {

             
            $entityManager = $doctrine->getManager();
            $listeutilisateur = $doctrine->getRepository(Utilisateur::class)->find($id);
            return $this->render('DetailUtilisateur.html.twig', ['utilisateur' => $listeutilisateur]);          
        }

        /**
        *@Route("SupprimerUtilisateur/{id}", name="SupprimerUtilisateur")
        */
        
        function SupprimerUtilisateur($id, ManagerRegistry $doctrine) {
            $entityManager = $doctrine->getManager();
            $listeutilisateur = $doctrine->getRepository(Utilisateur::class)->find($id);
            $entityManager->remove($listeutilisateur);
            $entityManager->flush($listeutilisateur);
            return $this->redirectToRoute("listeUtilisateur");       
        }

       /**
        *@Route("ModifierUtilisateur/{id}", name="ModifierUtilisateur")
        */

        function MofifierUtilisateur(Request $requestHTTP,ManagerRegistry $doctrine) {

            $utilisateur = new utilisateur();

            $formulaireUtilisateur = $this->createForm(UtilisateurForm :: class, $utilisateur);
    
            $formulaireUtilisateur->handleRequest($requestHTTP);


            if ($formulaireUtilisateur->isSubmitted() && $formulaireUtilisateur->isValid()) 
            {

                    $UtilisateurInfos = $formulaireUtilisateur->getData();
    
                    $entityManager = $doctrine->getManager();
                    
                    $entityManager->persist($UtilisateurInfos);
               
                    $entityManager->flush();
                    
                   return $this->redirectToRoute('listeUtilisateur');
            }

                    else
                    {
                    return $this->render('utilisateurform.html.twig' ,['utilisateurform' => $formulaireUtilisateur->createView()]);
                    }               
        }

    }     
?>
