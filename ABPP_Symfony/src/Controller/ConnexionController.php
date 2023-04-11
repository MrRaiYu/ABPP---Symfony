<?php
    namespace App\Controller;

    use App\Entity\Utilisateur;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\Persistence\ManagerRegistry;
    use App\Formulaire\ConnexionType;
use Symfony\Bridge\Doctrine\Test\TestRepositoryFactory;
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
                dump($realmdp);
                if ($realmdp == null)
                {
                    return new Response('Connexion échoué');
                }
                else
                {
                    return new Response('Connexion réussis');
                }
            }
            else
            {
                return $this->render('connexionform.html.twig', ['connexionform' => $formulaireUtilisateur->createView()]);
            }
        }
    }
?>