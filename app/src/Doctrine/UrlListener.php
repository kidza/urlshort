<?php

namespace App\Doctrine;

use App\Entity\Url;
use App\Utils\ShortCodeGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class UrlListener
{
    private $em;
    private $codeGenerator;

    public function __construct(EntityManagerInterface $em, ShortCodeGenerator $codeGenerator)
    {
        $this->em = $em;
        $this->codeGenerator = $codeGenerator;
    }

    public function prePersist(Url $url, LifecycleEventArgs $event): void
    {
        $generatedCode = "";
        $codeIsValid = false;

        while (!$codeIsValid) {
            //generate the short code
            $generatedCode = $this->codeGenerator->generateCode();

            //check if there is already that code in db - uniqueness
            $finding = $this->em->getRepository(Url::class)->findBy(array('shortCode' => $generatedCode));
            if (empty($finding)) {
                $codeIsValid = true;
            }
        }

        $url->setShortCode($generatedCode);
    }
}
