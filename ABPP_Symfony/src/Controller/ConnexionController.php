<?php
    namespace App\Controller;

    use LDAP\Result;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\Persistence\ManagerRegistry;
    use App\Entity\Utilisateur;
    use App\Formulaire\ConnexionType;
    use Symfony\Bridge\Doctrine\Test\TestRepositoryFactory;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;
 
    
    class ConnexionController extends AbstractController{

        /**
        * @Route("connexion", name="connexion")
        */
        function connexion(Request $requestHTTP, ManagerRegistry $doctrine, SessionInterface $session) {

            $utilisateur = new Utilisateur();
        
            $formulaireUtilisateur = $this->createForm(ConnexionType :: class, $utilisateur);
        
            $formulaireUtilisateur->handleRequest($requestHTTP);
        
            if ($formulaireUtilisateur->isSubmitted() && $formulaireUtilisateur->isValid()) {
        
                $login = $formulaireUtilisateur['util_login']->getData();
                $mdp = md5($formulaireUtilisateur['util_mdp']->getData()); //md5() qui hash le mot de passe en md5

                $realmdp = $doctrine->getRepository(Utilisateur::class)->findOneBy(['UtilLogin' => $login , 'UtilMDP' => $mdp]);

                if ($realmdp == null)
                {
                    $this->addFlash('error', 'Le couple Utilisateur/Mot de Passe est incorrect');
                    //return new Response('Utilisateur non existant');
                    return $this->render('connexionform.html.twig', ['connexionform' => $formulaireUtilisateur->createView()]);
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

                    return $this->redirectToRoute('listeEntreprises');  
                }
                if($roleId == 2)
                if($roleId == 2)
                {
                    // Stocker le username et le role dans une session
                    $session->set('username', $username);
                    $session->set('userRole', $userRole);

                    return $this->redirectToRoute('listeEntreprises');
                }
            }
            else
            {
                return $this->render('connexionform.html.twig', ['connexionform' => $formulaireUtilisateur->createView()]);
            }
        }
        
        /**
         * @Route("Administrateur", name="Administrateur")
         */
        function Administrateur() {
            return $this->render('Administrateur.html.twig');
        }
    }
?>