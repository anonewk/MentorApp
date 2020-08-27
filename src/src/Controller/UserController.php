<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Skill;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\SkillRepository;
use App\Entity\FrequencyPreferences;
use App\Entity\MentoringPreferences;
use App\Entity\UserSkill;
use App\Includes\ApplicationUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 */
class UserController extends ApplicationUser
{

    /**
     * @Route("/register", name="user_register", methods={"GET","POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager): Response
    {
        $opt = true;
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $user->initializeRegistrationDate();
            $user->setUpdateDate($user->getRegistrationDate());
            $user->setRoles(array('ROLE_USER'));
            $user->setIsAdmin(false);
            $user->setIsOnline(false);

            //$entityManager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/user_setting/{id}", name="user_setting", methods={"GET","POST"})
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function userSetting(Request $request, User $user): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $product = $repository->find($user->getEmailAddress());


        $mentoringPreferences = new MentoringPreferences();
        $this->getDoctrine()->getManager()->flush();

        //$datetime = new \DateTime();
        //$date = $datetime->format('Y-m-d');

        $dateMax = date('Y-m-d', strtotime('-16 year'));
        $dateMin = date('Y-m-d', strtotime('-116 year'));
        return $this->render('user/user_setting/user_setting.html.twig', [
            'dateMax' => $dateMax,
            'dateMin' => $dateMin,
            'user' => $user,
            'mentoringPreferences' => $mentoringPreferences,
        ]);
    }

    /**
     * @Route("/profile/{id}", name="user_profile", methods={"GET","POST"})
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function profile(Request $request, User $user): Response
    {

        $repository = $this->getDoctrine()->getRepository(User::class);
        $product = $repository->find($user->getId());
        $user = new User();
        $this->getDoctrine()->getManager()->flush();


        return $this->render('user/index.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/edit/{id}", name="user_edit", methods={"GET","POST"})
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/pg/{id}", name="update_pg")
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function userSetPg(Request $request, User $user, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        if ($request->request->get('value')) {
            $dataForm = $request->request->all();
            $data = $this->getUpdateParamUser($dataForm, $user, $request, $manager, $encoder);
        }

        if ($request->request->get('skill_name')) {
            $dataForm = $request->request->all();
            $data = $this->UpdateDeleteSkill($dataForm, $user, $request, $manager);
        }

        if ($request->request->get('nameContact')) {
            $dataForm = $request->request->all();
            $data = $this->CrudContactMethod($dataForm, $user, $request, $manager);
        }

        return new JsonResponse($data);

        $dateMax = date('Y-m-d', strtotime('-16 year'));
        $dateMin = date('Y-m-d', strtotime('-116 year'));

        return $this->render('user/user_setting/user_setting.html.twig', [
            'dateMax' => $dateMax,
            'dateMin' => $dateMin,
            'user' => $user
        ]);
    }

    /**
     * @Route("/search/skill", name="search_skill")
     */

    public function skillsSearch(Request $request, EntityManagerInterface $manager, SkillRepository $repo)
    {
        $data = [];
        if ($request->request->get('value')) {
            $value = $request->request->get('value');

            $skills = $repo->createQueryBuilder('o')
                ->where('o.name LIKE :name')
                ->setParameter('name', "%$value%")
                ->getQuery()
                ->getResult();

            if (count($skills) > 0) {
                $datas = '<ul class="ul_resul_skill" id="ul_resul_skill">';
                foreach ($skills as $skill) {
                    $datas .= '<li class="li_skill" id="' . $skill->getId() . '">' . $skill->getName() . '</li>';
                }
                $datas .= '</ul>';
                $data = ['success' => $datas];
            }
        }


        return new JsonResponse($data);

        $dateMax = date('Y-m-d', strtotime('-16 year'));
        $dateMin = date('Y-m-d', strtotime('-116 year'));
        return $this->render('user/user_setting/user_setting.html.twig', [
            'dateMax' => $dateMax,
            'dateMin' => $dateMin,
        ]);
    }
}
