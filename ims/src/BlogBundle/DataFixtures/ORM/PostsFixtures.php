<?php

namespace BlogBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BlogBundle\Entity\Posts;

class PostsFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $postsList = array(
            array(
              'title' => 'Post nr. 1',
              'secondTitle' => 'Standardowy fragment Lorem Ipsum, używany od XV w.',
              'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
              'createDate' => '2016-10-02 12:20:22',
              'author' => 'Admin'
          ),
            array(
                'title' => 'Post nr. 2',
                'secondTitle' => 'Standardowy fragment Lorem Ipsum, używany od XV w.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'createDate' => '2016-10-12 13:25:22',
                'author' => 'Admin'
            ),
            array(
                'title' => 'Post nr. 3',
                'secondTitle' => 'Standardowy fragment Lorem Ipsum, używany od XV w.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'createDate' => '2016-10-14 11:27:22',
                'author' => 'Admin'
            ),
            array(
                'title' => 'Post nr. 4',
                'secondTitle' => 'Standardowy fragment Lorem Ipsum, używany od XV w.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'createDate' => '2016-10-17 12:20:22',
                'author' => 'Admin'
            ),
            array(
                'title' => 'Post nr. 5',
                'secondTitle' => 'Standardowy fragment Lorem Ipsum, używany od XV w.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'createDate' => '2016-10-18 12:20:22',
                'author' => 'Admin'
            ),
            array(
                'title' => 'Post nr. 6',
                'secondTitle' => 'Standardowy fragment Lorem Ipsum, używany od XV w.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'createDate' => '2016-05-18 23:20:22',
                'author' => 'Admin'
            )
        );

        foreach($postsList as $details){
            $Posts = new Posts();
            $Posts->setTitle($details['title'])
                ->setSecondTitle($details['secondTitle'])
                ->setDescription($details['description'])
                ->setCreateDate(new \DateTime($details['createDate']))
                ->setAuthor($details['author']);

            $manager->persist($Posts);
        }

        $manager->flush();
    }


    public function getOrder()
    {
        return 0;
    }
}