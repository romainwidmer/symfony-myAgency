<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Coponent\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController {

  /**
   * @var PropertyRepository
   */
  private $repository;


  public function __construct(PropertyRepository $repository) {
    $this->repository = $repository;
  }

  /**
   * @Route("/properties", name="property.index")
   */
  public function index() {
    return $this->render('pages/properties/index.html.twig', [
      'current_menu' => 'properties'
    ]);
  }


  /**
   * @Route("/properties/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
   */
  public function show(Property $property, string $slug) {
    if($property->getSlug() !== $slug) {
      return $this->redirectToRoute('property.show', [
        'id' => $property->getId(),
        'slug' => $property->getSlug()
      ], 301);
    }

    return $this->render('pages/properties/show.html.twig', [
      'property' => $property,
      'current_menu' => 'properties'
    ]);
  }
}
