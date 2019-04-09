<?php
/**
 * Created by PhpStorm.
 * User: danbr
 * Date: 4/4/2019
 * Time: 1:58 PM
 */

namespace Woodpile\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="burnPeriods")
 */
class BurnPeriod
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
    protected $startBurn;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $endBurn;

    /**
     * @ORM\ManyToOne(targetEntity="Stack", inversedBy="burnHistory")
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
    public function getStartBurn(): \DateTime
    {
        return $this->startBurn;
    }

    /**
     * @param \DateTime $startBurn
     */
    public function setStartBurn(\DateTime $startBurn): void
    {
        $this->startBurn = $startBurn;
    }

    /**
     * @return \DateTime
     */
    public function getEndBurn(): \DateTime
    {
        return $this->endBurn;
    }

    /**
     * @param \DateTime $endBurn
     */
    public function setEndBurn(\DateTime $endBurn): void
    {
        $this->endBurn = $endBurn;
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
        $stack->addBurnPeriod($this);
        $this->stack = $stack;
    }
}