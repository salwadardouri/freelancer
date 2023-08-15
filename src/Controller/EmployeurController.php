<?php

namespace App\Controller;
use App\Entity\Employeurs;
use App\Repository\UserRepository;
use App\Repository\EmployeursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use FOS\RestBundle\View\View;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Serializer;
/**
 * @Route("/api")
 */
class EmployeurController extends AbstractFOSRestController
{ 
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder
    ) {
       
        $this->passwordEncoder = $passwordEncoder;

    }
/**
     * @Route("/employeur/register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): JsonResponse
    {
            $data = json_decode($request->getContent(), true);
 
    
            // Créez un nouvel employeur
            $employeur = new Employeurs();
            $employeur->setFirstname($data['firstname']);
            $employeur->setLastname($data['lastname']);
           
            $employeur->setEmail($data['email']);
            $employeur->setPassword($data['password']);
        
            $encodedPassword = $passwordEncoder->encodePassword($employeur, $data['password']);
        $employeur->setPassword($encodedPassword);

            $employeur->setRoles(array('ROLE_EMPLOYEUR'));          
            // Enregistrez l'employeur dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employeur);
            $entityManager->flush();
            // if (!is_null($employeur)) {
            //     return new JsonResponse([
            //         'message' => 'utilisateur déjà exists', "status" => Response::HTTP_CONFLICT
            //     ]);
            // }else {
                return new JsonResponse(['message' => 'Utilisateur enregistré avec succès.'], JsonResponse::HTTP_CREATED);
            }



 

      /**
     * @Route("/token")
     * Method({"GET"})
     */

    public function getcurrentuser()
    {
        $data =  $this->getUser();

        // Utilisez le groupe de sérialisation "GetOffreEmpoyeur" pour inclure uniquement les propriétés spécifiées dans l'entité "Employeurs".
        $view = View::create($data);
        $view->setContext($view->getContext()->addGroup('GetOffreEmpoyeur'));

        return $this->handleView($view);
    }
        /**
     * @Route("/employeur/get/{id}" )
     * Method({"GET"})
     */

public function GetOffreParIdEmployeur(EmployeursRepository $employeursRepository, $id)
{
    return $this->json($employeursRepository->findBy(['id' => $id]), 200, [], ['groups' => 'GetOffreEmpoyeur']);
}  
    
}