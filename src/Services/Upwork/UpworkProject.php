<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace projectivemotion\FreelancerBidder\Services\Upwork;
use projectivemotion\FreelancerBidder\Project;

/** @Entity */
class UpworkProject extends Project
{
    static function JsonToProject($job)
    {
        $data = [
            'description' => $job->description,
            'title'     => $job->title,
            'created'   => $job->createdOn,
            'ends'      => '',
            'URL'       => self::getJobPageURL($job),
            'num_bids'  => -1,
            'budget_min' => 0,
            'budget_max' => 0,
            'avg_bid' => 0
            ];
        $Project = new self($data);
        return $Project;
    }

    public static function getJobPageURL($jsonjob)
    {
        return sprintf("/o/jobs/job/_%s", $jsonjob->ciphertext);
    }
}