<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private const NB_ARTICLES = 40;

    private const CATEGORIES = ["PHP", "Symfony", "JS", "Typescript", "React", "Angular", "Rust"];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('zh_TW');

        $categories = [];

        foreach (self::CATEGORIES as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);

            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 0; $i < self::NB_ARTICLES; $i++) {
            $article = new Article();
            $article
                ->setTitle($faker->words($faker->numberBetween(4, 7), true))
                ->setContent($faker->realTextBetween(400, 1500))
                ->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-2 years')))
                ->setVisible($faker->boolean(80))
                ->setCategory($faker->randomElement($categories));

            $manager->persist($article);
        }

        // Envoyer les modifications en base de données
        $manager->flush();
    }
}
