<?php

namespace App\Controller;

use Exception;
use App\Entity\User;
use App\Entity\Skill;
use App\Entity\UserSkill;
use App\Entity\MentoringPreferences;
use App\Entity\MentoringContractRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MentorController extends AbstractController
{
    /**
     * Controlleur qui permet d'afficher les mentors
     *
     * @Route("/mentor_mentore/list", name="mentor_mentore_list")
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function listMentorMentore(EntityManagerInterface $manager)
    {
        $users = $manager->getRepository(User::class)->findAll();
        $Skills = $manager->getRepository(Skill::class)->findAll();
        
        

        return $this->render('mentor/list.html.twig', [
            'Users'=>$users,
            'Skills'=>$Skills

        ]);
    }

    /**
     * Fonction pour filtrer les mentors et mentorées
     *
     * @Route("/mentor_mentore/list_filter", name="mentor_mentore_list_filter")
     * @param EntityManagerInterface $manager
     * @param Request $request
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
     * @param Request $request
     * @param User $user
     * @return Response
     * @throws Exception
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
        $message ='
<div class="bg-teal-lightest border-t-4 border-teal rounded-b text-teal-darkest px-4 py-3 shadow-md my-2" role="alert">
  <div class="flex">
    <svg class="h-6 w-6 text-teal mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
    <div>
      <p class="font-bold">Votre demande de mentorat à été envoyé a '.$UserRecipient->getFullName().'</p>
      <p class="text-sm">Pour la compétence '.$UserSkill->getSkill()->getName().'</p>
    </div>
  </div>
</div>
';
/*Votre demande de Mentorat en <b>'.$UserSkill->getSkill()->getName().'</b> a été envoyé à <b>'.$UserRecipient->getFullName().'</b>';*/

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
     * @throws Exception
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
     * @Route("/mentor_mentore/relations/contrat/{id}", name="mentor_mentore_relations_contrat")
     * @param EntityManagerInterface $manager
     * @return Response
     * @throws Exception
     */

    // TODO Changer la route si nécessaire, remplir la fonction, remplir le back sur la page twig
    public function contrat($id, EntityManagerInterface $manager){

        /*dd($user);*/
        $datetime = new \DateTime();
        $date = $datetime->format('Y-m-d');
        $ContractRequest = $manager->getRepository(MentoringContractRequest::class)->find($id);

        return $this->render('mentor/relations/contrat/contrat.html.twig',['contractRequest'=>$ContractRequest]);
    }
    /**
     * Controller pour afficher le profil de mentor
     *
     * @Route("/mentor_mentore/relations/contrat/objectifs.html.twig", name="mentor_mentore_relations_contrat_objectif")
     * @param EntityManagerInterface $manager
     * @return Response
     * @throws Exception
     */

    // TODO Changer la route si nécessaire, remplir la fonction, remplir le back sur la page twig
    public function contratObjectifs(EntityManagerInterface $manager)
    {
        /*dd($user);*/
        $datetime = new \DateTime();
        $date = $datetime->format('Y-m-d');

        return $this->render('mentor/relations/contrat//objectifs/objectifs.html.twig');
    }

    /**
     * Route d'acceptation et réfus de contrat de mentoring
     *
     * @Route("/mentor_mentore/status", name="rule_request")
     */
    public function accepteRefuseContrat(Request $request, EntityManagerInterface $manager){
        $option=$request->request->get('option');
        $requestId=$request->request->get('idRequest');
        $MentoringContractRequest=$manager->getRepository(MentoringContractRequest::class)->find($requestId);
        $MentoringContractRequest->setStatus($option);
        $manager->persist($MentoringContractRequest);
        $manager->flush();
        $data=['reponse'=>'ok'];
        return new JsonResponse($data);
    }


}
