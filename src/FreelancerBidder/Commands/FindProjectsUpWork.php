<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace Projectivemotion\FreelancerBidder\Commands;


use Projectivemotion\FreelancerBidder\Upwork\Search;

class FindProjectsUpWork extends FindProjects
{
    public function Projects()
    {
        $Search = new Search();
        $Search->Execute();
        return $Search->Projects();
    }

    protected function configure()
    {
        $this->setName('upwork:find')
            ->setDescription('Display latest jobs from upwork.com');
    }
}