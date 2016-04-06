<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace Projectivemotion\FreelancerBidder\Freelancer;


use projectivemotion\BaseScraper;
use Projectivemotion\FreelancerBidder\Model\FreelancerCom;

class Search extends BaseScraper
{
    protected $domain   =   'www.freelancer.com';

    protected $service_params = [
        'scheme' => 'https',
        'host' => 'www.freelancer.com',
        'path' => '/ajax/table/project_contest_datatable.php',
        'post' => []
        ];

    protected $json_result  =   null;

    public function getPostParams()
    {
        return $this->service_params['post'];
    }

    function Reset()
    {
        $this->service_params['post'] = array (
            'sEcho' => '5',
            'iColumns' => '35',
            'sColumns' => '',
            'iDisplayStart' => '0',
            'iDisplayLength' => '10',
            'budget_min' => '560',
            'budget_max' => '1050',
            'skills_chosen' => '3', // php
            'verified_employer' => 'false',
            'bidding_ends' => 'N/A'
        );
    }

    function setParam(string $key, $value)
    {
        $this->service_params['post'][$key] = $value;
        return $this;
    }

    function JsonToProject(array $numericdata)
    {
        return FreelancerCom::FromNumericArray($numericdata);
    }

    function Execute()
    {
        $new_urlarray = $this->service_params;
        $url = sprintf("%s://%s%s",
            $new_urlarray['scheme'], $new_urlarray['host'],
            $new_urlarray['path']);
        $result =   $this->cache_get($url, $this->getPostParams());
        $this->json_result = json_decode($result);
    }

    /**
     * @return FreelancerCom[]
     */
    function getProjects()
    {
        foreach($this->json_result->aaData as $row)
        {
            yield $this->JsonToProject($row);
        }
    }

    function __construct()
    {
        $this->Reset();
    }
}