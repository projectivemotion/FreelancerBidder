<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace Projectivemotion\FreelancerBidder;
use Projectivemotion\FreelancerBidder\Commands\AddRule;
use Projectivemotion\FreelancerBidder\Commands\FindProjects;
use Projectivemotion\FreelancerBidder\Commands\FindProjectsFreelancer;
use Projectivemotion\FreelancerBidder\Commands\FindProjectsUpWork;
use Projectivemotion\FreelancerBidder\Commands\ImportProjects;
use Projectivemotion\FreelancerBidder\Commands\ListProjects;


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
        $config->addEntityNamespace('Projects', 'Projectivemotion\FreelancerBidder\Model');
        $config->addEntityNamespace('Rules', 'Projectivemotion\FreelancerBidder\Rules');

        $conn   =   ['driver' => 'pdo_sqlite', 'path' => __DIR__ . '/../../app/db.sqlite'];

        $entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);
        return $entityManager;
    }

    protected function registerProjectFinders()
    {
        $this->project_finders[]    =   new FindProjectsFreelancer();
        $this->project_finders[]    =   new FindProjectsUpWork();
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

        $commands[] =   new AddRule();
        $commands[] =   new ListProjects();
        return $commands;
    }


}