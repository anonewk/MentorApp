<?php

namespace App\DataFixtures;

use App\Entity\ContactMethod;
use App\Entity\FrequencyPreferences;
use App\Entity\MentoringPreferences;
use App\Entity\Picture;
use App\Entity\Skill;
use Faker\Factory;
use Faker\Provider\fr_Fr\Company;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class   AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function initializeProfilPicture()
    {
        if (empty($this->profilePicture)) {
            $folder = opendir('public/assets/profile/');
            $i = 0;

            while (false != ($file = readdir($folder))) {
                if ($file != "." && $file != "..") {
                    $images[$i] = $file;
                    $i++;
                }
            }

            $random_img = rand(0, count($images) - 1);
            $filename = 'public/assets/profile/' . $images[$random_img];
            // $fp = fopen($filename, 'rb');
            $data = file_get_contents($filename);
            // $data = fread($fp, filesize($filename));
            // $buf = addslashes($data);
            // fclose($fp);
            return $data;
        }
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        // Mot de passe utilisateur
        $plainPassword = 'password';
        $users = [];

        for ($x = 0; $x <= 10; $x++) {

            $userProfilePicture = new Picture();
            $userProfilePicture->setData($this->initializeProfilPicture())
                ->setContentType("image/jpg");

            $manager->persist($userProfilePicture);

            $user = new User();

            $encoded = $this->encoder->encodePassword($user, $plainPassword);

            $email = "john.doe@example.com";

            if ($x != 0) {
                $email =  $faker->email;
            }

            $user->setEmailAddress($email)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setPassword($encoded)
                ->setBirthDate($faker->dateTimeBetween($startDate = '-70 years', $endDate = '-18 years'))
                ->setRegistrationDate($faker->dateTimeThisYear($max = 'now'))

                ->setCountry($faker->country)
                ->setCompany($faker->company)
                ->setProfilePicture($userProfilePicture)
                ->setStatus($faker->jobTitle . ' à ' . $user->getCompany())
                ->setCity($faker->city)
                ->setSpokenLanguages(array('Français', 'Anglais'))
                ->setGender($faker->randomElement($array = array('male', 'female')))
                ->setIsAdmin(true)
                ->setIsOnline(false)
                ->setRoles(array('ROLE_USER'));
            $user->initializeUpdateDate();
            //->setProfilePicture($faker->image('public/assets/profile/', 400, 300, null, false))
            //->setUpdateDate($user->getRegistrationDate())

            $manager->persist($user);

            $frequencePreference = new FrequencyPreferences();
            $frequencePreference->setIsOnceAWeek(false)
                ->setIsTwiceAWeek(false)
                ->setIsOnceAMonth(false)
                ->setIsTwiceAMonth(false)
                ->setIsEveryDay(false);
            $manager->persist($frequencePreference);

            $mentorPreference = new MentoringPreferences();
            $mentorPreference->setIsPublicVisible(false)
                ->setFrequencyPreferences($frequencePreference);
            $manager->persist($mentorPreference);

            $user->setMentoringPreferences($mentorPreference);

            $contactMethodsArray = ['Skype', 'Teams'];
            $names = [$user->getFirstName(), $user->getFullName()];

            for ($i = 0; $i < count($contactMethodsArray); $i++) {

                $ContactMethod = new ContactMethod();
                $ContactMethod->setName($contactMethodsArray[$i])
                    ->setValue('@' . $names[$i])
                    ->setUser($user);

                $manager->persist($ContactMethod);
            }
        }

        $tabSkills = [
            'Accueillir des visiteurs',
            'Acheter au meilleur prix',
            'Analyser des documents juridiques',
            'Analyser une concurrence',
            'Animer des réunions',
            'Animer un blog',
            'Animer une réunion commerciale',
            'Assurer la veille technologique',
            'Assurer le suivi clientèle',
            'Auditer des comptes',
            'Changer un pneu de voiture',
            'Classer des documents',
            'Classer le courrier'
        ];

        foreach ($tabSkills as $skills) {
            $skill = new Skill();
            $skill->setName($skills);
            $manager->persist($skill);
        }

        $manager->flush();
    }
}
