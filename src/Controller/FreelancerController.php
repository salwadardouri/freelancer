<?php

namespace App\Controller;

use App\Entity\Freelancer;
use App\Service\FileUploader;
use FOS\RestBundle\View\View;
use App\Repository\FreelancerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;


use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
    /**
     * @Route("/api", name="app_freelancer")
     */
class FreelancerController extends AbstractController
{
    
    
    /**
     * @Route("/freelancer/register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, FileUploader $fileUploader)
    {
        $fileUploader = new FileUploader($this->getParameter('uploads_dir'));
        $data = json_decode($request->getContent(), true);
       
        // Créez un nouvel employeur
        $freelancer = new Freelancer();
        $freelancer->setFirstname('salwa');
        $freelancer->setLastname($data['lastname']);
        $encodedPassword = $passwordEncoder->encodePassword($freelancer, $data['password']);
        $freelancer->setPassword($encodedPassword);
        $freelancer->setEmail($data['email']);
        $freelancer->setRoles(array('ROLE_FREELANCER'));
        $freelancer->setCompetences($data['competences']);

        $cv = $request->files->get('Cv');
        $cv = $fileUploader->upload($cv);
        $photo = $request->files->get('Photo');
        $photo = $fileUploader->upload($photo);


        // Enregistrez l'employeur dans la base de données
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($freelancer);
        $entityManager->flush();

        // $responseData = [
        //     'message' => 'Utilisateur enregistré avec succès.',
        // ];
    
        // $json = $this->serializer->serialize($responseData, 'json', [
        //     'groups' => ['public'],
        // ]);
    
        // $jsonResponse = new JsonResponse($json, Response::HTTP_CREATED, [], true);
    
        // return $jsonResponse;
    
  return new JsonResponse(['message' => 'Utilisateur enregistré avec succès.'], JsonResponse::HTTP_CREATED);
 
    
    }
}