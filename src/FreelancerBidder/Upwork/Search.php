<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace Projectivemotion\FreelancerBidder\Upwork;

use Projectivemotion\FreelancerBidder\Model\UpWork;

class Search
{
    public function JsonToProject($job)
    {
        return UpWork::JsonToProject($job);
    }

    public function Projects()
    {
        $data   =   json_decode($this->json_result);
        foreach($data->searchResults->jobs as $job)
        {
            yield $this->JsonToProject($job);
        }
        return $data;
    }

    public function Execute()
    {
        $url = $this->CreateUrl();
        $this->json_result  =   file_get_contents($url);

    }

    public function CreateUrl()
    {
        $url ='https://www.upwork.com/o/jobs/browse/url?c=web-mobile-software-dev&sort=client_total_charge%2Bdesc';
        return $url;
    }
}