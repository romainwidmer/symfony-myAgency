<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use App\Form\PropertyType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController {

  /**
   * @var PropertyRepository
   */
  private $repository;

  /**
   * @var ObjectManager
   */
  private $manager;


  public function __construct(PropertyRepository $repository, ObjectManager $manager) {
    $this->repository = $repository;
    $this->manager = $manager;
  }


  /**
   * @Route("/admin", name="admin.property.index")
   * @return Response
   */
  public function index() {
    $properties = $this->repository->findAll();

    return $this->render('admin/properties/index.html.twig', [
      'properties' => $properties
    ]);
  }


  /**
   * @Route("/admin/property/edit/{id}", name="admin.property.edit", methods="GET|POST")
   * @param Property $property
   * @param Request $request
   * @return Response
   */
  public function edit(Property $property, Request $request) {
    $form = $this->createForm(PropertyType::class, $property);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
      $this->manager->flush();
      $this->addFlash('success', 'The property has been updated with success');
      return $this->redirectToRoute('admin.property.index');
    }

    return $this->render('admin/properties/edit.html.twig', [
      'property' => $property,
      'form' => $form->createView()
    ]);
  }


  /**
   * @Route("/admin/property/create", name="admin.property.new")
   * @param Request $request
   */
  public function new(Request $request) {
    $property = new Property();

    $form = $this->createForm(PropertyType::class, $property);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
      $this->manager->persist($property);
      $this->manager->flush();
      $this->addFlash('success', 'The property has been created with success');
      return $this->redirectToRoute('admin.property.index');
    }

    return $this->render('admin/properties/new.html.twig', [
      'property' => $property,
      'form' => $form->createView()
    ]);
  }


  /**
   * @Route("/admin/property/delete/{id}", name="admin.property.delete", methods="DELETE")
   * @param Property $property
   * @param Request $request
   * @return Response
   */
  public function delete(Property $property, Request $request) {
    if($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) {
      $this->manager->remove($property);
      $this->manager->flush();
      $this->addFlash('success', 'The property has been deleted with success');
    }
    return $this->redirectToRoute('admin.property.index');
  }
}
