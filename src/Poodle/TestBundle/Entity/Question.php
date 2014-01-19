<?php

namespace Poodle\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Question
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Exam", inversedBy="questions")
     * @ORM\JoinColumn(name="exam_id", referencedColumnName="id")
     */
    private $exam;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="string", length=255)
     */
    private $body;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="qType", type="string", length=50, nullable=true)
     */
    private $qType;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="question")
     */
    private $answers;


    
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }        
    
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
     * Set exam
     *
     * @param integer $exam
     * @return Question
     */
    public function setExam($exam)
    {
        $this->exam = $exam;

        return $this;
    }

    /**
     * Get exam
     *
     * @return integer 
     */
    public function getExam()
    {
        return $this->exam;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Question
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Question
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set qType
     *
     * @param string $qType
     * @return Question
     */
    public function setQType($qType)
    {
        $this->qType = $qType;

        return $this;
    }

    /**
     * Get qType
     *
     * @return string 
     */
    public function getQType()
    {
        return $this->qType;
    }

    /**
     * Add answers
     *
     * @param \Poodle\TestBundle\Entity\Answer $answers
     * @return Question
     */
    public function addAnswer(\Poodle\TestBundle\Entity\Answer $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \Poodle\TestBundle\Entity\Answer $answers
     */
    public function removeAnswer(\Poodle\TestBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}
