<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    class choixController extends AbstractController
    {
        /**
         * @Route("bofo", name="bofo")
         */
        function bofo()
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
    }
?>