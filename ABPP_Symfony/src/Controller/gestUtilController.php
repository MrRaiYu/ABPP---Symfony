<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    class gestUtilController extends AbstractController
    {
        /**
         * @Route("gestUtil", name="gestUtil")
         */
        function gestUtil()
        {
            return $this->render('gestUtil.html.twig');
        }
    }
?>