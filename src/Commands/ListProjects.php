<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace projectivemotion\FreelancerBidder\Commands;


use projectivemotion\FreelancerBidder\Application;

class ListProjects extends AbstractFindProjects
{
    public function Projects()
    {
        $EM = Application::getEntityManager();
        $repo = $EM->getRepository('Projects:Project');

        $rules = $EM->getRepository('Rules:StringMatch')->findAll();

        foreach($repo->findAll() as $P)
        {
            foreach($rules as /** @var BaseRule */$rule)
            {
                if($rule->Match($P))
                {
                    yield $P;
                }
            }
        }
    }

    protected function configure()
    {
        $this->setName('bidder:list')
                ->setDescription('List imported projects.');
    }


}