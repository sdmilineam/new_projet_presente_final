<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Form\ProfilType;
use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ProfilProController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    // Profil Pro pour midical

    /**
     * @Route("/profilpro", name="app_profil_pro")
     */
    public function index(ProfilRepository $profilRepository): Response
    {
        $profils = $profilRepository->findAll();

        return $this->render('profil_pro/index.html.twig', [
            'profils' => $profils,
        ]);
    }

    /**
     * @Route("/profilpro/create", name="app_create_profil",)
     */
    public function CreateProfil(EntityManagerInterface $em, Security $security, Request $request): Response
    {
        $profil = new Profil();
        $form = $this->createForm(ProfilType::class, $profil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->security->getUser();
            $profil->setUser($user);
            $em->persist($profil);
            $em->flush();

            $this->addFlash('success', 'Your __Profil__ has been created successfully.');

            return $this->redirectToRoute('app_profil_pro');
        }

        return $this->render('profil_pro/create.html.twig', [
            'profil' => $profil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profilpro/{id}", name="app_affiche_profil",requirements={"id"="\d+"})
     *
     * @param mixed $id
     */
    public function affiche(ProfilRepository $profilRepository, $id): Response
    {
        $profil = $profilRepository->find($id);

        return $this->render('profil_pro/affiche_profil.html.twig', [
            'profil' => $profil,
        ]);
    }

    /**
     * @Route("/profilpro/update/{id}", name="app_update_profilpro",)
     */
    public function Edite(profil $profil, EntityManagerInterface $em, Security $security, Request $request): Response
    {
        $user = $this->security->getUser();
        if ($user === $profil->getUser()) {
            $form = $this->createForm(ProfilType::class, $profil);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('app_profil_pro');
            }

            return $this->render('profil_pro/update.html.twig', [
                'profil' => $profil,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/profilpro/delete/{id}", name="app_delete_profilpro" )
     */
    public function delete(profil $profil, Request $request): Response
    {
        $user = $this->security->getUser();
        if ($user === $profil->getUser()) {
            if ($this->isCsrfTokenValid('delete'.$profil->getId(), $request->request->get('csrf_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($profil);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_profil_pro');
        }

        return $this->render('profil_pro/delete.html.twig', [
            'profil' => $profil,
            'form' => $form->createView(),
        ]);
    }
}
