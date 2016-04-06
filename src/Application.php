<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace projectivemotion\FreelancerBidder;
use projectivemotion\FreelancerBidder\Commands\AddRule;
use projectivemotion\FreelancerBidder\Commands\AbstractFindProjects;
use projectivemotion\FreelancerBidder\Commands\FindProjectsFreelancer;
use projectivemotion\FreelancerBidder\Commands\FindProjectsUpWork;
use projectivemotion\FreelancerBidder\Commands\ImportProjects;
use projectivemotion\FreelancerBidder\Commands\ListProjects;
use projectivemotion\FreelancerBidder\Services\Freelancer\FindProjectsCommand;


class Application extends  \Symfony\Component\Console\Application
{
    /**
     * @var FindProjects[]
     */
    protected $project_finders  =   [];

    static function getEntityManager()
    {
        $devMode = true;
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration([__DIR__], $devMode);
        $config->addEntityNamespace('Projects', 'projectivemotion\FreelancerBidder');
        $config->addEntityNamespace('Rules', 'Projectivemotion\FreelancerBidder\Rules');

        $conn   =   ['driver' => 'pdo_sqlite', 'path' => __DIR__ . '/../app/db.sqlite'];

        $entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);
        return $entityManager;
    }

    protected function registerProjectFinders()
    {
        $this->project_finders[]    =   new FindProjectsCommand();
        $this->project_finders[]    =   new \projectivemotion\FreelancerBidder\Services\Upwork\FindProjectsCommand();
    }

    /**
     * @return FindProjects[]
     */
    public function getProjectFinders()
    {
        return $this->project_finders;
    }

    protected function getDefaultCommands()
    {
        $this->registerProjectFinders();
        $commands = array_merge(parent::getDefaultCommands(), $this->project_finders);

        $commands[] = new ImportProjects($this);

//        $commands[] =   new AddRule();
        $commands[] =   new ListProjects();
        return $commands;
    }


}