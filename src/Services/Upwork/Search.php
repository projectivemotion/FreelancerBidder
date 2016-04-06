<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace projectivemotion\FreelancerBidder\Services\Upwork;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class Search
{
    /**
     * @var Response
     */
    protected $response;
    public function JsonToProject($job)
    {
        return UpworkProject::JsonToProject($job);
    }

    public function generateProjects()
    {
        if($this->response->getStatusCode() !=  200)
        {
            throw new \Exception("Bad Status Code for UpWork Search");
        }

        $data   =   json_decode($this->response->getBody());
        foreach($data->searchResults->jobs as $job)
        {
            yield $this->JsonToProject($job);
        }
        return $data;
    }

    public function Projects()
    {
        $Projects   =   [];
        foreach($this->generateProjects() as $Project)
        {
            $Projects[] =   $Project;
        }
        return $Projects;
    }

    public function Execute()
    {
        $url = $this->CreateUrl();
        $client =   new Client();
        $response   =   $client->request('GET', $url, [
            'headers'   =>  [
                'Referrer'  =>  'https://www.upwork.com/o/jobs/browse/?sort=create_time%2Bdesc',
                'accept'    =>  'application/json, text/plain, */*',
                'x-requested-with'  =>  'XMLHttpRequest'
            ]
        ]);

        
        $this->response =   $response;
    }

    public function CreateUrl()
    {
        $url ='https://www.upwork.com/o/jobs/browse/url?page=1&sort=create_time%2Bdesc';
        return $url;
    }
}