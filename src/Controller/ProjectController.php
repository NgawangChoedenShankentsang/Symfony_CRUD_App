<?php
namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'app_project_index', methods: ['GET'])]
    public function index(Request $request, ProjectRepository $projectRepository): Response
    {
        // Sorting
        $sortColumn = $request->query->get('sort', 'updated_at'); 
        $sortOrder = $request->query->get('order', 'desc'); 

        // Filter
        $filterParams = [
            'name' => $request->query->get('name'),
            'description' => $request->query->get('description')
        ];

         // Fetch projects with filters and sorting
        $projects = $projectRepository->findWithFilters($filterParams, [$sortColumn => $sortOrder]);
        
        $page = max(1, $request->query->getInt('page', 1));
        $limit = 9; 
        // Pass the limit to the repository method
        $paginator = $projectRepository->findWithFilters($filterParams, [$sortColumn => $sortOrder], $page, $limit);

        return $this->render('project/index.html.twig', [
            'projects' => $paginator,
            'current_page' => 'home',
            'current_page_number' => $page,
            'total_pages' => ceil(count($paginator) / $limit)
        ]);
    }


    #[Route('/new', name: 'create', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('create', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/new.html.twig', [
            'project' => $project,
            'form' => $form,
            'current_page' => 'create'
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_project_show', methods: ['GET'])]
    public function show(Project $project): Response
    {
        return $this->render('project/show.html.twig', [
          'project' => $project,
        ]);
    }

    #[Route('/{id<\d+>}/edit', name: 'app_project_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Project $project, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project/edit.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_project_delete', methods: ['POST'])]
    public function delete(Request $request, Project $project, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
    }
}
