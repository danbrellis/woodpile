<?php
/**
 * Created by PhpStorm.
 * User: danbr
 * Date: 3/21/2019
 * Time: 1:50 PM
 */

namespace Woodpile\Entities;
//https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/tutorials/getting-started.html

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @ORM\Entity
 * @ORM\Table(name="stacks")
 */
class Stack
{
    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $species;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $dateFelled;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $dateStacked;

    /**
     * @ORM\OneToMany(targetEntity="MoistureReading", mappedBy="stack")
     * @var MoistureReading[] An ArrayCollection of MoistureReading objects.
     **/
    protected $moistureHistory;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    protected $isSplit;

    /**
     * @ORM\Column(type="float")
     * @var float Given in feet
     */
    protected $width;

    /**
     * @ORM\Column(type="float")
     * @var float Given in feet
     */
    protected $height;

    /**
     * @ORM\Column(type="float")
     * @var float Given in feet
     */
    protected $depth;

    /**
     * @ORM\Column(type="boolean")
     * @var Boolean
     */
    protected $isBurnable;

    /**
     * @ORM\OneToMany(targetEntity="BurnPeriod", mappedBy="stack")
     * @var BurnPeriod[] An ArrayCollection of BurnPeriod objects.
     **/
    protected $burnHistory;

    /**
     * @ORM\ManyToOne(targetEntity="Pile", inversedBy="stacks")
     * @var Pile
     **/
    protected $pile;

    public function __construct()
    {
        $this->moistureHistory = new ArrayCollection();
        $this->burnHistory = new ArrayCollection();
    }

    public function getId(){
        return $this->id;
    }

    public function getSpecies(){
        return $this->species;
    }

    public function setSpecies($name){
        $this->species = $name;
    }

    public function getDateFelled(){
        return $this->dateFelled;
    }

    public function setDateFelled(\DateTime $date){
        $this->dateFelled = $date;
    }

    public function getDateStacked(){
        return $this->dateStacked;
    }

    public function setDateStacked(\DateTime $date){
        $this->dateStacked = $date;
    }

    /**
     * @return ArrayCollection
     */
    public function getMoistureHistory(): ArrayCollection
    {
        return $this->moistureHistory;
    }

    public function addMoistureReading(MoistureReading $reading){
        $this->moistureHistory[] = $reading;
    }

    public function getIsSplit(){
        return $this->isSplit;
    }

    public function setIsSplit(Boolean $boolean){
        $this->isSplit = $boolean;
    }

    public function getWidth(){
        return $this->width;
    }

    public function setWidth($val){
        $this->width = $val;
    }

    public function getHeight(){
        return $this->height;
    }

    public function setHeight($val){
        $this->height = $val;
    }

    public function getDepth(){
        return $this->depth;
    }

    public function setDepth($val){
        $this->depth = $val;
    }

    public function getIsBurnable(){
        return $this->isBurnable;
    }

    public function setIsBurnable(Boolean $boolean){
        $this->isBurnable = $boolean;
    }

    /**
     * @return ArrayCollection
     */
    public function getBurnHistory(): ArrayCollection
    {
        return $this->burnHistory;
    }

    public function addBurnPeriod($burnPeriod){
        $this->burnHistory[] = $burnPeriod;
    }

    /**
     * @return Pile
     */
    public function getPile(): Pile
    {
        return $this->pile;
    }

    /**
     * @param Pile $pile
     */
    public function setPile(Pile $pile): void
    {
        $pile->addStack($this);
        $this->pile = $pile;
    }

}