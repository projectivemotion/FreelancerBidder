<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace Projectivemotion\FreelancerBidder\Model;

/** @Entity */
class UpWork extends Project
{
    static function JsonToProject($job)
    {
        $data = [
            'description' => $job->description,
            'title'     => $job->title,
            'created'   => $job->createdOn,
            'ends'      => '',
            'URL'       => self::getJobPageURL($job)
            ];
        $Project = new self($data);
        return $Project;
    }

    public static function getJobPageURL($jsonjob)
    {
        return sprintf("/o/jobs/job/_%s", $jsonjob->ciphertext);
    }
}