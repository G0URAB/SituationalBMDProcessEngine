<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{

    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        foreach ($this->getUserData() as $userData) {
            $user = $manager->getRepository(User::class)->findOneBy(['email' => $userData['email']]);
            if (!$user) {
                $user = new User();
                $user->setEmployeeName($userData['name']);
                $user->setEmail($userData['email']);
                $user->setRoles($userData['roles']);
                $password = $this->encoder->hashPassword($user, $userData['password']);
                $user->setPassword($password);
                $manager->persist($user);
            }
        }

        $manager->flush();
    }

    public function getUserData()
    {
        return [

            [
                'name' => 'James Anderson',
                'email' => 'james@anderson.com',
                'roles' => ['ROLE_SUPER_ADMIN'],
                'password' => 'abc123'
            ],

            [
                'name' => 'Saul Brown',
                'email' => 'saul@brown.com',
                'roles' => ['ROLE_PROJECT_MANAGER'],
                'password' => 'abc123'
            ],

            [
                'name' => 'Alexander Belov',
                'email' => 'alexander@belov.com',
                'roles' => ['ROLE_PLATFORM_OWNER'],
                'password' => 'abc123'
            ],

            [
                'name' => 'Walter White',
                'email' => 'walter@white.com',
                'roles' => ['ROLE_METHOD_ENGINEER'],
                'password' => 'abc123'
            ],

            [
                'name' => 'Peter Gates',
                'email' => 'peter@gates.com',
                'roles' => ['ROLE_WEB_DEVELOPER'],
                'password' => 'abc123'
            ],

            [
                'name' => 'Adam Black',
                'email' => 'adam@black.com',
                'roles' => ['ROLE_WEB_DEVELOPER'],
                'password' => 'abc123'
            ],

            [
                'name' => 'Joyita Ambett',
                'email' => 'joyita@ambett.com',
                'roles' => ['ROLE_MARKETING_VP'],
                'password' => 'abc123'
            ],

            [
                'name' => 'Jane Brown',
                'email' => 'jane@brown.com',
                'roles' => ['ROLE_MARKETING_MANAGER'],
                'password' => 'abc123'
            ],

            [
                'name' => 'Samir Baptist',
                'email' => 'samir@baptist.com',
                'roles' => ['ROLE_MARKETING_EXECUTIVE'],
                'password' => 'abc123'
            ],

            [
                'name' => 'Amanda Wilson',
                'email' => 'amanda@wilson.com',
                'roles' => ['ROLE_SALES_VP'],
                'password' => 'abc123'
            ],

            [
                'name' => 'Daniel Yeh',
                'email' => 'daniel@yeh.com',
                'roles' => ['ROLE_SALES_MANAGER'],
                'password' => 'abc123'
            ],

            [
                'name' => 'Xavier Selvan',
                'email' => 'xavier@selvan.com',
                'roles' => ['ROLE_SALES_EXECUTIVE'],
                'password' => 'abc123'
            ]

        ];
    }

    public static function getGroups(): array
     {
         return ['testUsers'];
     }
}
