<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Skill;
use App\Entity\UserSkill;
use App\Entity\MentoringPreferences;
use App\Entity\MentoringContractRequest;
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
     * Fonction pour filtrer les mentors et mentorées
     *
     * @Route("/mentor_mentore/list_filter", name="mentor_mentore_list_filter")
     * 
     */
    public function listMentorMentoreFiltre(EntityManagerInterface $manager, Request $request){
        $users = $manager->getRepository(User::class)->findAll();

        $skills=$request->request->get('skills');
        $preferences=$request->request->get('preferences');
        if(!empty($skills)>=1 or !empty($preferences)>=1){
            
        }
        die();
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
     * Route pour demander un mentorat
     * 
     * @Route("/mentor/request/{id}", name="request_mentorat")
     * 
     */
    public function demandeMentorat($id,EntityManagerInterface $manager){
        $user=$manager->getRepository(User::class)->find($id);
        return $this->render('mentor/request.html.twig', ['User'=>$user]);
    }

    /**
     * Route pour traitement de la demande de mentorat
     *
     * @Route("mentorat/request/Send", name="mentorat_request_send")
     * 
     */
    public function sendDemande(Request $request, EntityManagerInterface $manager){
        $userId=$request->request->get('UserMentor');
        $SkillId=$request->request->get('UserSkill');
        $setUserSender=$this->getUser();
        $UserRecipient=$manager->getRepository(User::class)->find($userId);
        $UserSkill=$manager->getRepository(UserSkill::class)->find($SkillId);
        $MentoringContractRequest = new MentoringContractRequest();
        $MentoringContractRequest->initializePeremptionDate();
        $MentoringContractRequest->setStatus('pending');
        $MentoringContractRequest->setUserRecipient($UserRecipient);
        $MentoringContractRequest->setUserSender($setUserSender);
        $MentoringContractRequest->setSkillId($UserSkill);
        $message ='Votre demande de Mentorat en <b>'.$UserSkill->getSkill()->getName().'</b> a été envoyé à <b>'.$UserRecipient->getFullName().'</b>';
       
        $manager->persist($MentoringContractRequest);
        $manager->flush();

        

        return $this->render('mentor/profil.html.twig',['User' => $UserRecipient, 'flashMsg'=>$message]);
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
