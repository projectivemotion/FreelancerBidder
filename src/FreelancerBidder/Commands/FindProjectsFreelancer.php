<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace Projectivemotion\FreelancerBidder\Commands;


use Projectivemotion\FreelancerBidder\Freelancer\Search;

class FindProjectsFreelancer extends FindProjects
{
    protected function configure()
    {
        $this->setName('freelancer:find')
            ->setDescription('Display latest jobs from freelancer.com');
    }

    public function Projects()
    {
        $Search = new Search();
        $Search->Execute();
        return $Search->getProjects();
    }
}