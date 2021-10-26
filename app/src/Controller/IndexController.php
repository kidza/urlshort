<?php

namespace App\Controller;

use App\Entity\Url;
use App\Message\CountRedirection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class IndexController extends AbstractController
{
    public function index($shortCode, CacheInterface $redirectsCache, MessageBusInterface $messageBus): Response
    {
        $url = $redirectsCache->get($shortCode, function(ItemInterface $item) use ($shortCode){
            $em = $this->getDoctrine()->getManager();
            return $em->getRepository(Url::class)->findOneBy(array('shortCode' => $shortCode));
        });

        if (empty($url)) {
            throw $this->createNotFoundException('The url does not exist');
        } else {
            $message = new CountRedirection($url->getId());
            $messageBus->dispatch($message);

            return $this->redirect($url->getLongUrl());
        }
    }
}
