<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace projectivemotion\FreelancerBidder\Commands;

use projectivemotion\FreelancerBidder\Project;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

abstract class AbstractFindProjects extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach($this->Projects() as $Project)
        {
            $output->writeln($Project->getInlineDescription());
        }
    }

    /**
     * @return Project[]
     */
    abstract public function Projects();
}