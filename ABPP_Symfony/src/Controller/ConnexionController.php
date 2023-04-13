<?php
    namespace App\Controller;

    use App\Entity\Utilisateur;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\Persistence\ManagerRegistry;
    use App\Formulaire\ConnexionType;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;

    class ConnexionController extends AbstractController
    {
        /**
        * @Route("connexion", name="connexion")
        */
        function connexion(Request $requestHTTP, ManagerRegistry $doctrine, SessionInterface $session)
        {
            $utilisateur = new Utilisateur();
            $formulaireUtilisateur = $this->createForm(ConnexionType :: class, $utilisateur);
            $formulaireUtilisateur->handleRequest($requestHTTP);
            if ($formulaireUtilisateur->isSubmitted() && $formulaireUtilisateur->isValid())
            {
                $login = $formulaireUtilisateur['util_login']->getData();
                $mdp = $formulaireUtilisateur['util_mdp']->getData();
                $realmdp = $doctrine->getRepository(Utilisateur::class)->findOneBy(['UtilLogin' => $login , 'UtilMDP' => $mdp]);
                
                if ($realmdp == null)
                {
                    return new Response('Utilisateur non existant');
                }

                $username = $realmdp->getUtilLogin();
                $userRole = $realmdp->getProfil()->getProLib();
                // Récupérer l'ID du rôle de l'utilisateur
                $roleId = $realmdp->getProfil()->getId();

                if ($roleId == null) {
                    return new Response('Role non existant');
                }
                if($roleId == 1)
                {
                    // Stocker le username et le role dans une session
                    $session->set('username', $username);
                    $session->set('userRole', $userRole);

                    return $this->redirectToRoute("bofo");
                }
                if($roleId == 2)
                {
                    // Stocker le username et le role dans une session
                    $session->set('username', $username);
                    $session->set('userRole', $userRole);

                    return $this->render('listEntreprise.html.twig');
                }
            }
            else
            {
                return $this->render('connexionform.html.twig', ['connexionform' => $formulaireUtilisateur->createView()]);
            }
        }
    }
?>