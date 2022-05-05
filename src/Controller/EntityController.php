<?php

namespace App\Controller;

use App\Entity\Entity;
use App\Form\Entity1Type;
use App\Repository\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/entity')]
class EntityController extends AbstractController
{
    #[Route('/', name: 'app_entity_index', methods: ['GET'])]
    public function index(EntityRepository $entityRepository): Response
    {
        return $this->render('entity/index.html.twig', [
            'entities' => $entityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_entity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityRepository $entityRepository): Response
    {
        $entity = new Entity();
        $form = $this->createForm(Entity1Type::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityRepository->add($entity);
            return $this->redirectToRoute('app_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entity/new.html.twig', [
            'entity' => $entity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entity_show', methods: ['GET'])]
    public function show(Entity $entity): Response
    {
        return $this->render('entity/show.html.twig', [
            'entity' => $entity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_entity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Entity $entity, EntityRepository $entityRepository): Response
    {
        $form = $this->createForm(Entity1Type::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityRepository->add($entity);
            return $this->redirectToRoute('app_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entity/edit.html.twig', [
            'entity' => $entity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entity_delete', methods: ['POST'])]
    public function delete(Request $request, Entity $entity, EntityRepository $entityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entity->getId(), $request->request->get('_token'))) {
            $entityRepository->remove($entity);
        }

        return $this->redirectToRoute('app_entity_index', [], Response::HTTP_SEE_OTHER);
    }
}
