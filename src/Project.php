<?php
/**
 * Project: FreelancerBidder
 *
 * @author Amado Martinez <amado@projectivemotion.com>
 */

namespace projectivemotion\FreelancerBidder;


/**
 * Class Project
 * @package Projectivemotion\FreelancerBidder\Projects
 * @Entity
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="source", type="string")
 * @Table(name="projects")
 */
abstract class Project
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /**
     * @var string
     * @Column
     */
    protected $title;

    /**
     * @var string
     * @Column
     */
    protected $description;

    /**
     * @var integer
     * @Column
     */
    protected $num_bids;

    /**
     * @var string
     */
    protected $created;

    /**
     * @var string
     */
    protected $ends;

    /**
     * @var string
     * @Column
     */
    protected $PROJECTID = '';

    /**
     * @var string
     * @Column
     */
    protected $URL = '';

    /**
     * @var float
     * @Column
     */
    protected $budget_min;

    /**
     * @var float
     * @Column
     */
    protected $budget_max;

    /**
     * @var float
     * @Column(options={"default":0})
     */
    protected $avg_bid;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set numBids
     *
     * @param string $numBids
     *
     * @return Project
     */
    public function setNumBids($numBids)
    {
        $this->num_bids = $numBids;

        return $this;
    }

    /**
     * Get numBids
     *
     * @return string
     */
    public function getNumBids()
    {
        return $this->num_bids;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Project
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set ends
     *
     * @param \DateTime $ends
     *
     * @return Project
     */
    public function setEnds($ends)
    {
        $this->ends = $ends;

        return $this;
    }

    /**
     * Get ends
     *
     * @return \DateTime
     */
    public function getEnds()
    {
        return $this->ends;
    }

    /**
     * Set pROJECTID
     *
     * @param string $pROJECTID
     *
     * @return Project
     */
    public function setPROJECTID($pROJECTID)
    {
        $this->PROJECTID = $pROJECTID;

        return $this;
    }

    /**
     * Get pROJECTID
     *
     * @return string
     */
    public function getPROJECTID()
    {
        return $this->PROJECTID;
    }

    /**
     * Set uRL
     *
     * @param string $uRL
     *
     * @return Project
     */
    public function setURL($uRL)
    {
        $this->URL = $uRL;

        return $this;
    }

    /**
     * Get uRL
     *
     * @return string
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * Set budgetMin
     *
     * @param string $budgetMin
     *
     * @return Project
     */
    public function setBudgetMin($budgetMin)
    {
        $this->budget_min = $budgetMin;

        return $this;
    }

    /**
     * Get budgetMin
     *
     * @return string
     */
    public function getBudgetMin()
    {
        return $this->budget_min;
    }

    /**
     * Set budgetMax
     *
     * @param string $budgetMax
     *
     * @return Project
     */
    public function setBudgetMax($budgetMax)
    {
        $this->budget_max = $budgetMax;

        return $this;
    }

    /**
     * Get budgetMax
     *
     * @return string
     */
    public function getBudgetMax()
    {
        return $this->budget_max;
    }

    /**
     * Set avgBid
     *
     * @param string $avgBid
     *
     * @return Project
     */
    public function setAvgBid($avgBid)
    {
        $this->avg_bid = $avgBid;

        return $this;
    }

    /**
     * Get avgBid
     *
     * @return string
     */
    public function getAvgBid()
    {
        return $this->avg_bid;
    }

    function setField($column, $value)
    {
        $this->$column = $value;
    }

    public function getField($field)
    {
        return $this->$field;
    }

    function __construct($data = NULL)
    {
        foreach($data as $key => $value)
            $this->setField($key, $value);
    }

    function getInlineDescription()
    {
        return sprintf("%s ($%s)", $this->getTitle(), $this->getAvgBid());
    }
}