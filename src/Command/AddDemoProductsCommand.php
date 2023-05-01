<?php

namespace App\Command;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'products:add-demo')]
class AddDemoProductsCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->entityManager
            ->persist(new Product(
                name: "That's not a cat, that's an octopus",
                price: 359,
                image: 'octo.jpg'
            ));
        $this->entityManager
            ->persist(new Product(
                name: 'Warm rabbit costume with a hood for your cat',
                price: 659,
                image: 'pink.jpg'
            ));
        $this->entityManager
            ->persist(new Product(
                name: 'Hawaiian shirt for serious intentions',
                price: 499,
                image: 'tropic.jpg'
            ));
        $this->entityManager
            ->persist(new Product(
                name: 'Vampire costume, beware, he will bite you!',
                price: 899,
                image: 'devil.jpg'
            ));
        $this->entityManager
            ->persist(new Product(
                name: 'Funny anime costume Tanjiro Campoko',
                price: 1699,
                image: 'naruto.jpg'
            ));
        $this->entityManager
            ->persist(new Product(
                name: "Chucky's Halloween costume for your kitty",
                price: 1239,
                image: 'scary.jpg'
            ));
        $this->entityManager
            ->persist(new Product(
                name: 'Anime costume Zenitsu from the anime "Demon Slayer"',
                price: 1359,
                image: 'naruto_2.jpg'
            ));
        $this->entityManager
            ->persist(new Product(
                name: 'Winter cat costume dinosaur. For small cat clothes',
                price: 1500,
                image: 'dino.jpg'
            ));

        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
