<?php

namespace App\Serializer;

use App\Entity\Freelancer;

use Symfony\Component\Routing\RouterInterface;

class CircularReferenceHandler
{
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function __invoke($object)
    {
        // switch ($object) {
        //     case $object instanceof TaskList:
        //         return $this->router->generate('app_list_getlistsbyid  ', ['id' => $object->getId()]);
        //         case $object instanceof Task:
        //             return $this->router->generate('app_task_gettaskactions', ['id' => $object->getId()]);
        //         // case $object instanceof Note:
        //         //     return $this->router->generate('get_note', ['note' => $object->getId()]);
        // }
        return $object->getId();
    }
}