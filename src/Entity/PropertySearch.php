<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

class PropertySearch {

  /**
   * @var int|null
   */
  private $maxPrice;

  /**
   * @var int|null
   * @Assert\Range(min=10, max=400)
   */
  private $minSurface;

  /**
   * @var ArrayCollection
   */
  private $features;



  public function __construct() {
    $this->features = new ArrayCollection();
  }


  public function getMaxPrice(): ?int {
    return $this->maxPrice;
  }

  public function setMaxPrice(int $maxPrice): PropertySearch {
    $this->maxPrice = $maxPrice;
    return $this;
  }

  public function getMinSurface(): ?int {
    return $this->minSurface;
  }

  public function setMinSurface(int $minSurface): PropertySearch {
    $this->minSurface = $minSurface;
    return $this;
  }

  /**
   * @return ArrayCollection
   */
  public function getFeatures(): ArrayCollection {
    return $this->features;
  }

  /**
   *@param ArrayCollection $options
   */
  public function setFeatures(ArrayCollection $features): void {
    $this->features = $features;
  }


}
