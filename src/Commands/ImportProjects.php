<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace projectivemotion\FreelancerBidder\Commands;

use Doctrine\DBAL\Driver\PDOException;
use Doctrine\ORM\EntityManager;
use projectivemotion\FreelancerBidder\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;



class ImportProjects extends Command
{
    /**
     * @var Application
     */
    protected $app;

    public function __construct(Application $application)
    {
        parent::__construct(null);
        $this->app  =   $application;
    }

    protected function configure()
    {
        $this->setName('bidder:import')
            ->setDescription('Import newest jobs.');

        $this->addArgument('website', InputArgument::OPTIONAL, "Which website.", "ALL");
    }

    public function ImportProjects(AbstractFindProjects $FinderCommand, EntityManager $em, OutputInterface $output)
    {
        $output->writeln("Executing " . $FinderCommand->getName());
        foreach($FinderCommand->Projects() as $Project)
        {
            $output->write(".");
            $em->persist($Project);
        }
        $output->writeln("");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = Application::getEntityManager();
        $website = $input->getArgument('website');

        if($website == 'ALL')
            $finders    =   $this->app->getProjectFinders();
        else{
            $finders = [$this->getApplication()->find($website . ':find')];
        }

        foreach($finders as $FinderCommand)
        {
            $this->ImportProjects($FinderCommand, $em, $output);
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