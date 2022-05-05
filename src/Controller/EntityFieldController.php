<?php

namespace App\Controller;

use App\Entity\EntityField;
use App\Form\EntityFieldType;
use App\Repository\EntityFieldRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/entity-fields')]
class EntityFieldController extends AbstractController
{
    #[Route('/', name: 'app_entity_field_index', methods: ['GET'])]
    public function index(EntityFieldRepository $entityFieldRepository): Response
    {
        return new JsonResponse([
                                [ 'id' => '1', 'name' => 'school', 'type' => 'string', 'constraints' => 'true'],
                                [ 'id' => '2', 'name' => 'student', 'type' => 'string', 'constraints' => 'max=100'],
                            ]);
        
        return $this->render('entity_field/index.html.twig', [
            'entity_fields' => $entityFieldRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_entity_field_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityFieldRepository $entityFieldRepository): Response
    {
        $entityField = new EntityField();
        $form = $this->createForm(EntityFieldType::class, $entityField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityFieldRepository->add($entityField);
            return $this->redirectToRoute('app_entity_field_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entity_field/new.html.twig', [
            'entity_field' => $entityField,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entity_field_show', methods: ['GET'])]
    public function show(EntityField $entityField): Response
    {
        return $this->render('entity_field/show.html.twig', [
            'entity_field' => $entityField,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_entity_field_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityField $entityField, EntityFieldRepository $entityFieldRepository): Response
    {
        $form = $this->createForm(EntityFieldType::class, $entityField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityFieldRepository->add($entityField);
            return $this->redirectToRoute('app_entity_field_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entity_field/edit.html.twig', [
            'entity_field' => $entityField,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entity_field_delete', methods: ['POST'])]
    public function delete(Request $request, EntityField $entityField, EntityFieldRepository $entityFieldRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entityField->getId(), $request->request->get('_token'))) {
            $entityFieldRepository->remove($entityField);
        }

        return $this->redirectToRoute('app_entity_field_index', [], Response::HTTP_SEE_OTHER);
    }
}
