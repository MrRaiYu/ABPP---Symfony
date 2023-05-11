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
        *@Route("AjouterUtil", name="AjouterUtil")
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
                    
                   return $this->redirectToRoute('listeUtil');
            }

                    else
                    {
                    return $this->render('utilisateurform.html.twig' ,['utilisateurform' => $formulaireUtilisateur->createView()]);
                    }               
        }

        /**
        *@Route("listeUtil", name="listeUtil")
        */

        function listeUtilisateurs(Request $requestHTTP,ManagerRegistry $doctrine) {
            
            $entityManager = $doctrine->getManager();
            $listeutilisateurs = $entityManager->getRepository(Utilisateur::class)->findAll();
            $titre = 'Liste des utilisateurs';

            return $this->render('listeutilisateurs.html.twig' ,['Titre' => $titre, 'listeutilisateurs'=> $listeutilisateurs]);
        }  
        
        /**
        *@Route("DetailUtil/{id}", name="DetailUtili")
        */

        function DetailUtilisateur($id, ManagerRegistry $doctrine) {

             
            $entityManager = $doctrine->getManager();
            $listeutilisateurs = $doctrine->getRepository(Utilisateur::class)->find($id);
            return $this->render('DetailUtilisateur.html.twig', ['utilisateur' => $listeutilisateurs]);          
        }

        /**
        *@Route("SupprimerUtil/{id}", name="SupprimerUtil")
        */
        
        function SupprimerUtilisateur($id, ManagerRegistry $doctrine) {
            $entityManager = $doctrine->getManager();
            $listeutilisateurs = $doctrine->getRepository(Utilisateur::class)->find($id);
            $entityManager->remove($listeutilisateurs);
            $entityManager->flush($listeutilisateurs);
            return $this->redirectToRoute("listeUtilisateurs");       
        }

       /**
        *@Route("ModifierUtil/{id}", name="ModifierUtil")
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
                    
                   return $this->redirectToRoute('listeUtil');
            }

                    else
                    {
                    return $this->render('utilisateurform.html.twig' ,['utilisateurform' => $formulaireUtilisateur->createView()]);
                    }               
        }

    }     
?>
