<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace Projectivemotion\FreelancerBidder\Freelancer;


use Projectivemotion\FreelancerBidder\Model\FreelancerCom;

class Search
{
    protected $service_params = [
        'scheme' => 'https',
        'host' => 'www.freelancer.com',
        'path' => '/ajax/table/project_contest_datatable.php',
        'post' => []
        ];

    protected $json_result  =   null;

    function Reset()
    {
        $this->service_params['post'] = array (
            'sEcho' => '5',
            'iColumns' => '35',
            'sColumns' => '',
            'iDisplayStart' => '0',
            'iDisplayLength' => '500',
            'budget_min' => '560',
            'budget_max' => '1050',
            'skills_chosen' => '3', // php
            'verified_employer' => 'false',
            'bidding_ends' => 'N/A'
        );
    }

    function setParam(string $key, $value)
    {
        $this->service_params['post'] = $value;
        return $this;
    }

    // @todo rewrite, make cleaner, use php 7 funcs
    function CreateUrl()
    {
        $new_urlarray = $this->service_params;
        $query_string = http_build_query($new_urlarray['post']);

        $url = sprintf("%s://%s%s?%s",
            $new_urlarray['scheme'], $new_urlarray['host'],
            $new_urlarray['path'], $query_string);

        return $url;
    }

    function JsonToProject(array $numericdata)
    {
        return FreelancerCom::FromNumericArray($numericdata);
    }

    function Execute()
    {
        $this->json_result = file_get_contents($this->CreateUrl());
    }

    /**
     * @return FreelancerCom[]
     */
    function Projects()
    {
        $data   =   json_decode($this->json_result);
        foreach($data->aaData as $row)
        {
            yield $this->JsonToProject($row);
        }
    }

    function __construct()
    {
        $this->Reset();
    }
}