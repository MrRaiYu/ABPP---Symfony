<?php
    namespace App\Controller;

    use App\Entity\Login;
    use App\Entity\Role;
    use LDAP\Result;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\Persistence\ManagerRegistry;
    use App\Formulaire\LoginForm;
    use Symfony\Component\Form\FormTypeInterface;
 
    
    class LoginController extends AbstractController{

    /**
     * @Route("FormLogin", name="FormLogin")
     */
    function CreateLoginform(Request $requestHTTP, ManagerRegistry $doctrine) {

        $login = new Login();
    
        $formulaireLogin = $this->createForm(LoginForm::class, $login);
    
        $formulaireLogin->handleRequest($requestHTTP);
    
        if ($formulaireLogin->isSubmitted() && $formulaireLogin->isValid()) {
    
            $id = $formulaireLogin['identifiant']->getData();
            $mdp = $formulaireLogin['mdp']->getData();

            $user = $doctrine->getRepository(Login::class)->findOneBy(['identifiant' => $id , 'mdp' => $mdp]);
    
            if ($user == null)
            {
                return new Response('Utilisateur non existant');
            }
            // Récupérer l'ID du rôle de l'utilisateur
                $roleId = $user->getRole()->getId();

            if ($roleId == null) {
                return new Response('Role non existant');
            }
            if($roleId == 1)
            {
                return $this->render('Administrateur.html.twig');
            }
            if($roleId == 2)
            {
                return $this->render('Enseignant.html.twig');
            }
        }
        else
        {
            return $this->render('loginform.html.twig', ['loginform' => $formulaireLogin->createView()]);
        }
    }
}
?>