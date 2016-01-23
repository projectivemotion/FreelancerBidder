<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace Projectivemotion\FreelancerBidder\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;


use Projectivemotion\FreelancerBidder\Model\Search;

abstract class FindProjects extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach($this->Projects() as $Project)
        {
            $output->writeln($Project->getInlineDescription());
        }
    }

    abstract public function Projects();
}