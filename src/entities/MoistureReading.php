<?php
/**
 * Created by PhpStorm.
 * User: danbr
 * Date: 4/3/2019
 * Time: 3:18 PM
 */

namespace Woodpile\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="moistureReadings")
 */
class MoistureReading
{
    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $dateTaken;
    /**
     * @ORM\Column(type="float")
     * @var float
     */
    protected $reading;

    /**
     * @ORM\ManyToOne(targetEntity="Stack", inversedBy="moistureHistory")
     * @var Stack
     **/
    protected $stack;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDateTaken(): \DateTime
    {
        return $this->dateTaken;
    }

    /**
     * @param \DateTime $dateTaken
     */
    public function setDateTaken(\DateTime $dateTaken): void
    {
        $this->dateTaken = $dateTaken;
    }

    /**
     * @return float
     */
    public function getReading(): float
    {
        return $this->reading;
    }

    /**
     * @param float $reading
     */
    public function setReading(float $reading): void
    {
        $this->reading = $reading;
    }

    /**
     * @return Stack
     */
    public function getStack(): Stack
    {
        return $this->stack;
    }

    /**
     * @param Stack $stack
     */
    public function setStack(Stack $stack): void
    {
        $stack->addMoistureReading($this);
        $this->stack = $stack;
    }


}