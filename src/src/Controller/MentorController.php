<?php

namespace App\Controller;

use App\Entity\MentoringPreferences;
use App\Entity\Skill;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
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
        $usersSkills = $manager->getRepository(Skill::class)->findAll();
        


        return $this->render('mentor/list.html.twig', [
            'Users'=>$users,

        ]);
    }

    /**
     * Controller pour afficher le profil de mentor
     *
     * @Route("/mentor_mentore/profil/{id}", name="mentor_mentore_profil")
     */
    public function profilMentor($id, EntityManagerInterface $manager){
        $user=$manager->getRepository(User::class)->find($id);
        return $this->render('mentor/profil.html.twig',['User' => $user]);
    }
}
