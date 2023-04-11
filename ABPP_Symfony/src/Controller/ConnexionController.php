<?php
    namespace App\Controller;

    use App\Entity\Utilisateur;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\Persistence\ManagerRegistry;
    use App\Formulaire\ConnexionType;
    use Symfony\Component\HttpFoundation\Response;

    class ConnexionController extends AbstractController
    {
        /**
         * @Route("connexion", name="connexion")
         */
        function connexion(Request $requeteHTTP, ManagerRegistry $doctrine)
        {
            $utilisateur = new Utilisateur();
            $formulaireUtilisateur = $this->createForm(ConnexionType :: class, $utilisateur);
            $formulaireUtilisateur->handleRequest($requeteHTTP);
            if ($formulaireUtilisateur->isSubmitted() && $formulaireUtilisateur->isValid())
            {
                $login = $formulaireUtilisateur['util_login']->getData();
                $mdp = $formulaireUtilisateur['util_mdp']->getData();
                $realmdp = $doctrine->getRepository(Utilisateur::class)->findOneBy(['UtilLogin' => $login , 'UtilMDP' => $mdp]);
                if ($realmdp == null)
                {
                    return new Response('Connexion échoué');
                }
                else
                {
                    return $this->redirectToRoute("bofo");
                }
            }
            else
            {
                return $this->render('connexionform.html.twig', ['connexionform' => $formulaireUtilisateur->createView()]);
            }
        }

        /**
         * @Route("bofo", name="bofo")
         */
        function bofo(Request $requeteHTTP, ManagerRegistry $doctrine)
        {
            return $this->render('bofo.html.twig');
        }

        /**
         * @Route("choixGestion", name="choixGestion")
         */
        function choixGestion()
        {
            return $this->render('choixGestion.html.twig');
        }

        /**
         * @Route("gestEntreprise", name="gestEntreprise")
         */
        function gestEntreprise()
        {
            return $this->render('gestEntreprise.html.twig');
        }

        /**
         * @Route("gestUtil", name="gestUtil")
         */
        function gestUtil()
        {
            return $this->render('gestUtil.html.twig');
        }

        /**
         * @Route("listEleves", name="listEleves")
         */
        function listEleves()
        {
            return new Response('Page listEleves');
        }
    }
?>