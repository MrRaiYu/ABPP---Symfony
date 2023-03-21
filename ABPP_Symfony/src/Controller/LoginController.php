<?php
    namespace App\Controller;

    use App\Entity\Login;
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
        function CreateLoginform(Request $requestHTTP,ManagerRegistry $doctrine) {

            $login= new login();
 
            $formulaireLogin = $this->createForm(LoginForm :: class, $login);
    
            $formulaireLogin->handleRequest($requestHTTP);


            if ($formulaireLogin->isSubmitted() && $formulaireLogin->isValid()) 
            {
                
                    $LoginInfos = $formulaireLogin->getData();
    
                    $entityManager = $doctrine->getManager();
                    
                    $entityManager->persist($LoginInfos);
               
                    $entityManager->flush();
                    
                   return $this->redirectToRoute('Admi');
            }
            else
            {
                   return $this->render('loginform.html.twig' ,['loginform' => $formulaireLogin->createView()]);
            }              
        }
    }
    

?>