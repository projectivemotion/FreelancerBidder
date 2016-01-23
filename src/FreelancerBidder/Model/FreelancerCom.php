<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace Projectivemotion\FreelancerBidder\Model;


/** @Entity */
class FreelancerCom extends Project
{
    static function FromNumericArray($data)
    {
        $obj = [
            'PROJECTID' => $data[0],
            'title' => html_entity_decode($data[1]),
            'description' => html_entity_decode($data[2]),
            'num_bids' => $data[3],
            'created' => date('Y-m-d', strtotime($data[6])),
            'ends' => date('Y-m-d', strtotime($data[7])),
            'avg_bid' => str_replace('$', '', $data[9]),
            'URL' => $data[21],
            'budget_min' => (float)$data[32]->minbudget_usd,
            'budget_max' => (float)$data[32]->maxbudget_usd
            ];

        $Project = new self($obj);
        return $Project;
    }
}