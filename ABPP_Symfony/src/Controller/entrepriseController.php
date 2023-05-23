<?php
    namespace App\Controller;
    use Doctrine\Persistence\ManagerRegistry;
    use App\Formulaire\EntrepriseForm;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use App\Entity\Entreprise;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\Specialite;
    use App\Formulaire\RechercheEntreprise;
    use Doctrine\DBAL\Query;
 


    class EntrepriseController extends AbstractController {

        /**
        *@Route("listeEntreprises", name="listeEntreprises")
        */

        function listeEntreprises(Request $requestHTTP,ManagerRegistry $doctrine) {
            
            $entityManager = $doctrine->getManager();
            $listeentreprises = $entityManager->getRepository(Entreprise::class)->findAll();
            $titre = 'Liste des entreprises';
             // Initialiser un tableau pour stocker les spécialités de chaque entreprise
            // $specialitesEntreprises = [];

            // Pour chaque entreprise, récupérer ses spécialités
            // foreach ($listeentreprises as $entreprise)
            // {
            //     $specialites = $entreprise->getSpecialites();
            //     foreach ($specialites as $specialite)
            //     {
            //         $specialiteentreprises[$entreprise->getId()][] = $specialite->getSpeLib();
            //     }
            // }
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

            // Récupérer les spécialités actuelles de l'entreprise
            $specialites = $listeentreprises->getSpecialites()->toArray();

             // Créer un formulaire pour modifier les spécialités de l'entreprise
            $formulaireSpecialites = $this->createForm(EntrepriseForm::class, $specialites);
    
            $formulaireEntreprise->handleRequest($requestHTTP);
            $formulaireSpecialites->handleRequest($requestHTTP);


            if ($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid() || $formulaireSpecialites->isSubmitted() && $formulaireSpecialites->isValid())
            {

                    $EntrepriseInfos = $formulaireEntreprise->getData();
      
                    $entityManager = $doctrine->getManager();
                    
                    $entityManager->persist($EntrepriseInfos);
               
                    $entityManager->flush();
                    
                    // Mettre à jour les spécialités de l'entreprise
                    $specialites = $formulaireSpecialites->getData();
                    $entityManager = $doctrine->getManager();
                    $entityManager->persist($listeentreprises);
                    $entityManager->flush();

                   return $this->redirectToRoute('listeEntreprises');
            }

                    else
                    {
                    return $this->render('entrepriseform.html.twig' ,['entrepriseform' => $formulaireEntreprise->createView()]);
                    }             
        }
    }
