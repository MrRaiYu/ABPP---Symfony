<?php
    namespace App\Controller;
    use Doctrine\Persistence\ManagerRegistry;
    use App\Formulaire\PersonnelForm;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\Personnel;


    class PersonnelController extends AbstractController {


         /**
        *@Route("AjouterPersonnel", name="AjouterPersonnel")
        */
        function AjouterPersonnel(Request $requestHTTP,ManagerRegistry $doctrine) {

            $personnel = new personnel();

            $formulairePersonnel = $this->createForm(PersonnelForm :: class, $personnel);
    
            $formulairePersonnel->handleRequest($requestHTTP);


            if ($formulairePersonnel->isSubmitted() && $formulairePersonnel->isValid()) 
            {

                    $PersonnelInfos = $formulairePersonnel->getData();
    
                    $entityManager = $doctrine->getManager();
                    
                    $entityManager->persist($PersonnelInfos);
               
                    $entityManager->flush();
                    
                   return $this->redirectToRoute('listePersonnel');
            }

                    else
                    {
                    return $this->render('personnelform.html.twig' ,['personnelform' => $formulairePersonnel->createView()]);
                    }               
        }

        /**
        *@Route("listePersonnel", name="listePersonnel")
        */

        function listePersonnel(Request $requestHTTP,ManagerRegistry $doctrine) {
            
            $entityManager = $doctrine->getManager();
            $listepersonnel = $entityManager->getRepository(Personnel::class)->findAll();

            return $this->render('listepersonnel.html.twig' ,['listepersonnel'=> $listepersonnel]);
        }  
        
        /**
        *@Route("DetailPersonnel/{id}", name="DetailPersonnel")
        */

        function DetailPersonnel($id, ManagerRegistry $doctrine) {

             
            $entityManager = $doctrine->getManager();
            $listepersonnel = $doctrine->getRepository(Personnel::class)->find($id);
            return $this->render('DetailPersonnel.html.twig', ['personnel' => $listepersonnel]);          
        }

        /**
        *@Route("SupprimerPersonnel/{id}", name="SupprimerPersonnel")
        */
        
        function SupprimerPersonnel($id, ManagerRegistry $doctrine) {
            $entityManager = $doctrine->getManager();
            $listepersonnel	 = $doctrine->getRepository(Personnel::class)->find($id);
            $entityManager->remove($listepersonnel);
            $entityManager->flush($listepersonnel);
            return $this->redirectToRoute("listePersonnel");       
        }

       /**
        *@Route("ModifierPersonnel/{id}", name="ModifierPersonnel")
        */

        function MofifierPersonnel(Request $requestHTTP,ManagerRegistry $doctrine) {

            $personnel = new personnel();

            $formulairePersonnel = $this->createForm(PersonnelForm :: class, $personnel);
    
            $formulairePersonnel->handleRequest($requestHTTP);


            if ($formulairePersonnel->isSubmitted() && $formulairePersonnel->isValid()) 
            {

                    $PersonnelInfos = $formulairePersonnel->getData();
    
                    $entityManager = $doctrine->getManager();
                    
                    $entityManager->persist($PersonnelInfos);
               
                    $entityManager->flush();
                    
                   return $this->redirectToRoute('listePersonnel');
            }

                    else
                    {
                    return $this->render('personnelform.html.twig' ,['personnelform' => $formulairePersonnel->createView()]);
                    }               
        }
    }     
?>