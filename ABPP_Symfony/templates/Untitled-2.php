
<?php
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
        
    ?>