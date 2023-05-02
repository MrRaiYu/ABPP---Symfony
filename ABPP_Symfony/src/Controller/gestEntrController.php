<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    class gestEntrController extends AbstractController
    {
        /**
         * @Route("gestEntreprise", name="gestEntreprise")
         */
        function gestEntreprise()
        {
            return $this->render('gestEntreprise.html.twig');
        }
    }
?>