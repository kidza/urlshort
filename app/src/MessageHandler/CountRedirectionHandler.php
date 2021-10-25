<?php

namespace App\MessageHandler;

use App\Entity\Counter;
use App\Entity\Url;
use App\Message\CountRedirection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CountRedirectionHandler implements MessageHandlerInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(CountRedirection $countRedirection)
    {
        $urlId = $countRedirection->getUrlId();
        $url = $this->em->getRepository(Url::class)->find($urlId);
        if (empty($url)) {
            //TODO Log miss
            return;
        }
        $counter = $this->em->getRepository(Counter::class)->findOneBy(array('url' => $url));

        if (empty($counter)) {
            $counter = new Counter();
            $counter->setUrl($url);
        }

        $counter->setNumberOfRedirects($counter->getNumberOfRedirects() + 1);

        $this->em->persist($counter);
        $this->em->flush();
    }
}
