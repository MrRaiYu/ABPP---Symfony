<?php
    namespace App\Controller;
    use Doctrine\Persistence\ManagerRegistry;
    use App\Formulaire\FormPays;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use App\Entity\Pays;
    use Symfony\Component\HttpFoundation\Request;

    class PaysController extends AbstractController
    {
        /**
        *@Route("addPays", name="addPays")
        */
        function AjouterPays(Request $requestHTTP,ManagerRegistry $doctrine)
        {
            $pays = new pays();

            $formulairePays = $this->createForm(FormPays :: class, $pays);

            $formulairePays->handleRequest($requestHTTP);


            if ($formulairePays->isSubmitted() && $formulairePays->isValid()) 
            {

                $PaysInfos = $formulairePays->getData();

                $entityManager = $doctrine->getManager();

                $entityManager->persist($PaysInfos);

                $entityManager->flush();

                return $this->redirectToRoute('AjouterEntreprise');
            }

            else
            {
                return $this->render('paysform.html.twig' ,['paysform' => $formulairePays->createView()]);
            }
        }        
    }

?>