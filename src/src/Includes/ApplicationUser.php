<?php

namespace App\Includes;

use App\Entity\ContactMethod;
use App\Entity\User;
use App\Entity\Skill;
use App\Entity\UserSkill;
use App\Entity\MentoringPreferences;
use App\Repository\SkillRepository;
use App\Repository\UserSkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApplicationUser extends AbstractController
{

    /**
     * Pour avoir une configuration de base de champs
     *
     */

    protected function getUpdateParamUser($dataForm = [], $user, $request, $manager, $encoder, $entity = [])
    {

        $data = array();
        $field =  $dataForm['field'];
        $value = $dataForm['value'];
        if ($field == 'emailAddress') {
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $sql = $manager->getRepository(User::class)->findBy(["emailAddress" => $value]);
                if (empty($sql)) {
                    $user->setEmailAddress($value);
                    $manager->persist($user);
                    $manager->flush();
                    $data = ['success' => "success"];
                } else {
                    $data = ['erreur' => "Cette adresse email est déjà utilisée !"];
                }
            } else {
                $data = ['erreur' => "Ce format n'est pas valide !"];
            }
        }

        if ($field == 'lastName') {
            if ($value == '') {
                $data = ['erreur' => "Ce champ doit être renseigné !"];
            } else {
                $user->setLastName($value);
                $manager->persist($user);
                $manager->flush();
                $data = ['success' => "success"];
            }
        }

        if ($field == 'firstName') {
            if ($value == '') {
                $data = ['erreur' => "Ce champ doit être renseigné !"];
            } else {
                $user->setFirstName($value);
                $manager->persist($user);
                $manager->flush();
                $data = ['success' => "success"];
            }
        }

        if ($field == 'status') {
            if ($value == '') {
                $data = ['erreur' => "Ce champ doit être renseigné !"];
            } else {
                $user->setStatus($value);
                $manager->persist($user);
                $manager->flush();
                $data = ['success' => "success"];
            }
        }

        if ($field == 'city') {
            if ($value == '') {
                $data = ['erreur' => "Ce champ doit être renseigné !"];
            } else {
                $user->setCity($value);
                $manager->persist($user);
                $manager->flush();
                $data = ['success' => "success"];
            }
        }

        if ($field == 'spokenLanguages') {
            if ($value == '') {
                $data = ['erreur' => "Ce champ doit être renseigné !"];
            } else {
                $value = explode(", ", $value);
                $user->setSpokenLanguages($value);
                $manager->persist($user);
                $manager->flush();
                $data = ['success' => "success"];
            }
        }

        if ($field == 'birthDate') {
            if ($value == '') {
                $data = ['erreur' => "Ce champ doit être renseigné !"];
            } else {
                $user->setBirthDate(new \DateTime($value));
                $manager->persist($user);
                $manager->flush();
                $data = ['success' => "success"];
            }
        }

        if ($field == 'company') {
            if ($value == '') {
                $data = ['erreur' => "Ce champ doit être renseigné !"];
            } else {
                $user->setCompany($value);
                $manager->persist($user);
                $manager->flush();
                $data = ['success' => "success"];
            }
        }

        if ($field == 'password') {
            $newPwc = $dataForm['check'];
            $oldPw =  $dataForm['oldPw'];
            if ($value == '' || $newPwc == '' || $oldPw == '') {
                $data = ['erreur' => "Tous les champs doivent être remplis !"];
            } else {
                if (strlen($value) < 8) {
                    $data = ['erreur' => "Le mot de passe doit contenir au mons 8 caractères !"];
                } else {
                    if ($value != $newPwc) {
                        $data = ['erreur' => "Les mots de passe ne sont pas identiques !"];
                    } else {

                        if (!password_verify($oldPw, $user->getPassword())) {
                            $data = ['erreur' => "L'ancien mot de passe est incorrect !"];
                        } else {
                            $newHash = $encoder->encodePassword($user, $value);
                            $user->setPassword($newHash);
                            $manager->persist($user);
                            $manager->flush();
                            $data = ['success' => "success"];
                        }
                    }
                }
            }
        }

        if ($field == 'isPublicVisible') {
            if ($value == '') {
                $data = ['erreur' => "Ce champ doit être renseigné !"];
            } else {
                if ($value == 'Oui') {
                    $val = true;
                } else {
                    $val = false;
                }
                if (empty($user->getMentoringPreferences())) {
                    $mentoringPref = new MentoringPreferences();
                    $mentoringPref->setIsPublicVisible($val);
                    $user->setMentoringPreferences($mentoringPref);
                } else {
                    $user->getMentoringPreferences()->setIsPublicVisible($val);
                }

                $manager->persist($user);
                $manager->flush();
                $data = ['success' => "success"];
            }
        }

        if ($field == 'onceAweek' ||  $field == 'twiceAweek' || $field == 'everyDay' || $field == 'OnceAMonth' || $field == 'twiceAmonth') {
            if ($value == 'true') {
                if ($field == 'onceAweek') {
                    $user->getMentoringPreferences()->getFrequencyPreferences()->setIsOnceAWeek(true);
                }
                if ($field == 'twiceAweek') {
                    $user->getMentoringPreferences()->getFrequencyPreferences()->setIsTwiceAWeek(true);
                }
                if ($field == 'everyDay') {
                    $user->getMentoringPreferences()->getFrequencyPreferences()->setIsEveryDay(true);
                }
                if ($field == 'OnceAMonth') {
                    $user->getMentoringPreferences()->getFrequencyPreferences()->setIsOnceAMonth(true);
                }
                if ($field == 'twiceAmonth') {
                    $user->getMentoringPreferences()->getFrequencyPreferences()->setIsTwiceAMonth(true);
                }
            } else {
                if ($field == 'onceAweek') {
                    $user->getMentoringPreferences()->getFrequencyPreferences()->setIsOnceAWeek(false);
                }
                if ($field == 'twiceAweek') {
                    $user->getMentoringPreferences()->getFrequencyPreferences()->setIsTwiceAWeek(false);
                }
                if ($field == 'everyDay') {
                    $user->getMentoringPreferences()->getFrequencyPreferences()->setIsEveryDay(false);
                }
                if ($field == 'OnceAMonth') {
                    $user->getMentoringPreferences()->getFrequencyPreferences()->setIsOnceAMonth(false);
                }
                if ($field == 'twiceAmonth') {
                    $user->getMentoringPreferences()->getFrequencyPreferences()->setIsTwiceAMonth(false);
                }
            }


            $manager->persist($user);
            $manager->flush();
            $data = ['success' => "success"];
        }

        if (isset($dataForm['typeOp'])) {
            $typeOp = $dataForm['typeOp'];
            $nameSkill = $value;
            $level = $dataForm['level'];
            $idSkill = $dataForm['field'];
            $verifSkill = $manager->getRepository(Skill::class)->findOneBy(["name" => $nameSkill]);



            $user_skill = new UserSkill();
            $user_skill->setLevel($level);
            $user_skill->setUser($user);

            if (!empty($verifSkill)) {
                $user_skill->setSkill($verifSkill);
            } else {
                $skill = new Skill();
                $skill->setName($nameSkill);
                $manager->persist($skill);
                $user_skill->setSkill($skill);
            }
            $manager->persist($user_skill);
            $manager->persist($user);
            $manager->flush();
            $data = ['success' => "Une compétence à été ajoutée !"];
        }

        /*
            $query = $manager->createQuery(
                "SELECT COUNT (p) AS retenu
         FROM App\Entity\Proposition p
         LEFT JOIN App\Entity\Reponse r 
         WITH p.id=r.idProposition   
         WHERE p.vrai = '1' AND  r.idProposition IS NULL"
            );


            $result = $query->execute();*/
        //$arrData = ['value' => $value, 'field' => $field];

        return $data;
    }

    protected function UpdateDeleteSkill($dataForm = [], $user, $request, $manager)
    {
        $data = [];
        $id = $dataForm['idUserSkill'];
        $skillValue = $dataForm['skill_name'];
        $level = $dataForm['level_skil'];
        $op = $dataForm['op'];

        if ($op == "update_skill") {
            if ($skillValue != "" && $level != "") {
                $repoSkill = $manager->getRepository(Skill::class);
                $skill = $repoSkill->findOneBy(['name' => $skillValue]);
                if (empty($skill)) {
                    $skill = new Skill();
                    $skill->setName($skillValue);
                    $manager->persist($skill);
                }
                $repoUserSkill = $manager->getRepository(UserSkill::class);
                $userSkill = $repoUserSkill->findOneBy(['id' => $id]);
                $userSkill->setSkill($skill);
                $userSkill->setLevel($level);
                $manager->persist($userSkill);
                $manager->flush();

                $data = ['success' => "La compétence a été modifiée !"];
            }
        }

        if ($op == "delete_skill") {
            $repoUserSkill = $manager->getRepository(UserSkill::class);
            $userSkill = $repoUserSkill->findOneBy(['id' => $id]);
            $manager->remove($userSkill);
            $manager->flush();
            $data = ['success' => "La compétence a été supprimée!"];
        }


        return $data;
    }

    protected function CrudContactMethod($dataForm = [], $user, $request, $manager)
    {
        $data = [];
        $id = $dataForm['idContact'];
        $name = ucfirst($dataForm['nameContact']);
        $value = $dataForm['valueContact'];
        $op = $dataForm['opContact'];

        if ($op == "delete") {
            $ContactMethod = $manager->getRepository(ContactMethod::class)->find($id);
            if (!empty($ContactMethod)) {
                $manager->remove($ContactMethod);
                $manager->flush();
                $data = ["success" => "Ce moyen de contact a été supprimé !"];
            }
        }
        if ($op == "update") {
            if ($name != '' && $value != '') {
                $ContactMethod = $manager->getRepository(ContactMethod::class)->findBy(['Name' => $name, 'Value' => $value]);
                if (empty($ContactMethod)) {
                    $contactM = $manager->getRepository(ContactMethod::class)->find($id);
                    $contactM->setName($name)
                        ->setValue($value);
                    $manager->persist($contactM);
                    $manager->flush();
                    $data = ["success" => "La modification a été effectuée !", "name" => $name, "id" => $id, "value" => $value];
                } else {
                    $data = ['error' => 'Ce contact existe déjà !'];
                }
            } else {
                $data = ['error' => 'Tout les champs sont obligatoire !'];
            }
        }

        if ($op == "create") {
            if ($name != '' && $value != '') {
                $ContactMethod = $manager->getRepository(ContactMethod::class)->findBy(['Name' => $name, 'Value' => $value]);
                if (empty($ContactMethod)) {
                    $contactM = new ContactMethod();
                    $contactM->setName($name)
                        ->setValue($value)
                        ->setUser($user);
                    $manager->persist($contactM);
                    $manager->flush();
                    $id = $contactM->getId();
                    $html = '<hr id="hr_contactM_' . $id . '" class="border-b-2 border-gray-900 mx-6" style="color:#ececec;">
                           <div id="div_contactM_' . $id . '" class="flex flex-row bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <div>
                                    <label class="text-sm leading-5 font-bold text-gray-500 labelContact data_contact label_' . $id . ' data_contact_' . $id . '">
                                        ' . $name . '
                                    </label>
                                    <input id="input_nameContact_' . $id . '" type="text" value="' . $name . '" class="input_contact input_contact_' . $id . '">
                                </div>
                                <div>
                                    <p class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2 data_contact p_' . $id . ' data_contact_' . $id . '">
                                        ' . $value . '
                                    </p>
                                    <input id="input_valueContact_' . $id . '" type="text" value="' . $value . '" class="input_contact input_contact_' . $id . '">
                                    <input data-value="' . $value . '" data-op="update" data-name="' . $name . '" data-idc="' . $id . '" class="btn-submit-contact btn_submit_' . $id . ' input_contact input_contact_' . $id . '"  type="boutton" value="Valider">
                                    <input data-value="' . $value . '" data-op="delete" data-name="' . $name . '" data-idc="' . $id . '" class="btn-submit-contact btn_submit_' . $id . ' input_contact input_contact_' . $id . '"  type="boutton" value="Supprimer">
                                </div>
                                    
                                <div id="div_iconpen_' . $id . '">
                                     
                                </div>
                    </div>"';

                    $data = ["success" => "Ce moyen a été ajouté !", "html" => $html, "name" => $name, "id" => $id, "value" => $value];
                } else {
                    $data = ['error' => 'Ce contact existe déjà !'];
                }
            } else {
                $data = ['error' => 'Tout les champs sont obligatoire !'];
            }
        }

        return $data;
    }
}
