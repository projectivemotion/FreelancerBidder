<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace Projectivemotion\FreelancerBidder\Commands;

use Doctrine\DBAL\Driver\PDOException;
use Projectivemotion\FreelancerBidder\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;


use Projectivemotion\FreelancerBidder\Freelancer\Search;


class ImportProjects extends Command
{
    protected function configure()
    {
        $this->setName('bid:refresh')
            ->setDescription('Refresh local projects database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $Search = new Search();
        $Search->Execute();

        $em =   Application::getEntityManager();
        foreach($Search->Projects() as $Project)
        {
            $output->write(".");
            $em->persist($Project);
        }

        try {
            $em->flush();
        }Catch(PDOException $exception)
        {
            throw $exception;
        }
        $output->writeln("Done.");
    }

}