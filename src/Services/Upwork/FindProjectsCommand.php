<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace projectivemotion\FreelancerBidder\Services\Upwork;


use projectivemotion\FreelancerBidder\Commands\AbstractFindProjects;

class FindProjectsCommand extends AbstractFindProjects
{
    public function Projects()
    {
        $Search = new Search();
        $Search->Execute();
        return $Search->generateProjects();
    }

    protected function configure()
    {
        $this->setName('upwork:find')
            ->setDescription('Display latest jobs from upwork.com');
    }
}