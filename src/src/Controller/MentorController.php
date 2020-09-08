<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Skill;
use App\Entity\MentoringPreferences;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MentorController extends AbstractController
{
    /**
     * Controlleur qui permet d'afficher les mentors
     *
     * @Route("/mentor_mentore/list", name="mentor_mentore_list")
     * @param EntityManagerInterface $manager
     * @param User $user
     * @return Response
     */
    public function listMentorMentore(EntityManagerInterface $manager)
    {
        $users = $manager->getRepository(User::class)->findAll();
        $Skills = $manager->getRepository(Skill::class)->findAll();
        
        

        return $this->render('mentor/list.html.twig', [
            'Users'=>$users, 'Skills'=>$Skills

        ]);
    }

    /**
     * Controller pour afficher le profil de mentor
     *
     * @Route("/mentor_mentore/profil/{id}", name="mentor_mentore_profil")
     * @param $id
     * @param EntityManagerInterface $manager
     * @return Response
     * @throws \Exception
     */
    public function profilMentor(Request $request, User $user){
        $repository = $this->getDoctrine()->getRepository(User::class);
/*dd($user);*/
        $datetime = new \DateTime();
        $date = $datetime->format('Y-m-d');

        return $this->render('mentor/profil.html.twig',['User' => $user]);
    }
    /**
     * Controller pour afficher le profil de mentor
     *
     * @Route("/mentor_mentore/relations", name="mentor_mentore_relations")
     * @param EntityManagerInterface $manager
     * @return Response
     * @throws \Exception
     */
    // TODO Changer la route si nécessaire, remplir la fonction, remplir le back sur la page twig
    public function relation(EntityManagerInterface $manager)
    {

        /*dd($user);*/
        $datetime = new \DateTime();
        $date = $datetime->format('Y-m-d');

        return $this->render('mentor/relations/relations.html.twig');
    }

    /**
     * Controller pour afficher le profil de mentor
     *
     * @Route("/mentor_mentore/relations/contrat", name="mentor_mentore_relations_contrat")
     * @param EntityManagerInterface $manager
     * @return Response
     * @throws \Exception
     */

    // TODO Changer la route si nécessaire, remplir la fonction, remplir le back sur la page twig
    public function contrat(EntityManagerInterface $manager){

        /*dd($user);*/
        $datetime = new \DateTime();
        $date = $datetime->format('Y-m-d');

        return $this->render('mentor/relations/contrat/contrat.html.twig');
    }
    /**
     * Controller pour afficher le profil de mentor
     *
     * @Route("/mentor_mentore/relations/contrat/objectifs.html.twig", name="mentor_mentore_relations_contrat_objectif")
     * @param EntityManagerInterface $manager
     * @return Response
     * @throws \Exception
     */

    // TODO Changer la route si nécessaire, remplir la fonction, remplir le back sur la page twig
    public function contratObjectifs(EntityManagerInterface $manager)
    {
        /*dd($user);*/
        $datetime = new \DateTime();
        $date = $datetime->format('Y-m-d');

        return $this->render('mentor/relations/contrat//objectifs/objectifs.html.twig');
    }


}
