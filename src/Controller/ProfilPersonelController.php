<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdatProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ProfilPersonelController extends AbstractController
{
    /**
     * @Route("/profil/personel", name="profil_personel")
     */
    public function index(Security $security): Response
    {
        $user = $security->getUser();

        return $this->render('profil_personel/index.html.twig', [
            'user' => $user,
        ]);
    }

    // Miss a jour profil //

    /**
     * @Route("/profil/update", name="app_update_profil",)
     */
    public function Edite(EntityManagerInterface $em, Security $security, Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UpdatProfilType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Profil = $security->getUser();
            $em->flush();

            return $this->redirectToRoute('profil_personel');
        }

        return $this->render('profil_personel/update.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    // DELETE ACC USER //

    /**
     * @Route("/profil/delete/{id}", name="app_delete_profil", )
     */
    public function delete(EntityManagerInterface $em, Security $security, Request $request): Response
    {
        $user = $this->getUser();
        if ($this->isCsrfTokenValid('delete'.$user->getId($user), $request->request->get('csrf_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            session_destroy();
        }

        return $this->redirectToRoute('app_home');
    }
}
