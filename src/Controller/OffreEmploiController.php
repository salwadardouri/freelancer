<?php

namespace App\Controller;

use App\Entity\Employeurs;
use App\Entity\OffreEmploi;
use App\Repository\UserRepository;
use FOS\RestBundle\Context\Context;
use App\Repository\EmployeursRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OffreEmploiRepository;
use App\Repository\OffreEmploisRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api")
 */
class OffreEmploiController extends AbstractController
{  /**
    * @var EntityManagerInterface
    */
   private $entityManager;

   public function __construct(EntityManagerInterface $entityManager)
   {

       $this->entityManager = $entityManager;
   }


  /**
 * @Route("/offre-emploi/create", methods={"POST"})
 */
public function create(Request $request, EntityManagerInterface $entityManager):JsonResponse
{ $data = json_decode($request->getContent(), true);
    // Créez une nouvelle offre d'emploi
    $offreEmploi = new OffreEmploi();
    $offreEmploi->setTitre($data['titre']);
    $offreEmploi->setDescription($data['description']);
    $offreEmploi->setCompetencesRequises($data['competences_requises']);
    $offreEmploi->setBudget($data['budget']);
    $offreEmploi->setDateLimite($data['date_limite']);
    $offreEmploi->setCategory($data['Category']);
    $offreEmploi->setIsAccepted(false);



    // Recherchez l'employeur en utilisant son ID
 
    $employeur = $entityManager->getRepository(Employeurs::class)
        ->findOneBy(['id' => $data['employeurs']]);

    $offreEmploi->setEmployeurs($employeur);

    // $offreEmploi->setEmployeur($this->getUser()); // Utilisateur actuellement authentifié (employeur)

    // Enregistrez l'offre d'emploi dans la base de données
    $entityManager->persist($offreEmploi);
    $entityManager->flush();

    return $this->json('Création réussie !!');
}
   /**
     * @Route("/offre-emploi/update/{id}")
     * Method({"PUT"})
     */
    public function update(Request $request, $id): Response
    {
        try {
            $data = $this->getDoctrine()->getRepository(OffreEmploi::class)->find($id);

            $parameter = json_decode($request->getContent(), true);
            $data->setTitre($parameter['titre']);
            $data->setDescription($parameter['description']);
            $data->setCompetencesRequises($parameter['competences_requises']);
            $data->setBudget($parameter['budget']);
            $data->setDateLimite($parameter['date_limite']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            return new JsonResponse([
                'status' => 'PUT success'
            ], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse([
                'status' => 'Unable to put this sujet .'
            ], JsonResponse::HTTP_FAILED_DEPENDENCY);
        }
    }
     /**
     * @Route("/offre-emploi/delete" )
     * Method({"DELETE"})
     */
    public function deleteAll(EntityManagerInterface $em): Response
    {
        $data = $this->getDoctrine()->getRepository(OffreEmploi::class)->findAll();
        foreach ($data as $data) {
            $em->remove($data);
        }

        $em->flush();
        return $this->json('Deleted Successfully!!');
    }
  
  
    /**
     * @Route("/offre-emploi/get/{id}" )
     * Method({"GET"})
     */

public function GetOffreParIdEmployeur(OffreEmploiRepository $OffreEmploiRepository, $id)
{
    return $this->json($OffreEmploiRepository->findBy(['id' => $id]), 200, [], ['groups' => 'GetOffreEmpoyeur']);
}  
 
     /**
     * @Route("/offre-emploi/get",  methods={"GET"})
     */
    public function getAll(OffreEmploiRepository $offreemploiRepository)
    {

        return $this->json($offreemploiRepository->findAll(), 200, [], ['groups' => 'GetOffreEmpoyeur']);
    }

  
    
    }
