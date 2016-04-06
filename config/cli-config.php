<?php
/**
 * Project: FreelancerBidder
 * Required for doctrine database schema modifications.
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

require __DIR__ . '/../vendor/autoload.php';

return Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(\projectivemotion\FreelancerBidder\Application::getEntityManager());