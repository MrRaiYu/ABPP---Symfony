<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Response;

    class entrepriseController extends AbstractController
    {
        /**
         * @Route("listEntreprise", name="listEntreprise")
         */
        function listEntreprise()
        {
            return new Response('Page listEntreprise');
        }
    }
?>