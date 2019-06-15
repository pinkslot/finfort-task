<?php

namespace App\Controller;

use App\Model\Changelog\Changelog;
use App\Model\Release;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return Changelog
     */
    private function deserializeDataFile()
    {
        $fileContent = file_get_contents($this->getParameter('kernel.project_dir') . "/data/changelog.xml");

        $deserializationContext = new DeserializationContext();
        $deserializationContext->setGroups(["Default", Release::DESERIALIZE_GROUP]);

        /**
         * @var Changelog $objectData
         */
        $objectData = $this->serializer->deserialize($fileContent, Changelog::class, 'xml', $deserializationContext);

        return $objectData;
    }

    /**
     * @param Serializer $serializer
     *
     * @Route("/", name="index", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SerializerInterface $serializer)
    {
        $changelog = $this->deserializeDataFile();

        return $this->render('index/index.html.twig', [
            'changelog' => $changelog->getChangelog(),
        ]);
    }

    /**
     * @param Serializer $serializer
     *
     * @Route("/changelog", name="changelog", methods={"GET"})
     *
     * @return Response
     */
    public function changelog(SerializerInterface $serializer)
    {
        $objectData = $this->deserializeDataFile();

        $serializationContext = new SerializationContext();
        $serializationContext->setGroups(["Default", 'items' => [Release::SERIALIZE_GROUP]]);
        $arrayData = $serializer->toArray($objectData, $serializationContext);

        return new JsonResponse($arrayData);
    }
}
