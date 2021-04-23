<?php

namespace App\Services;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class Serializer
{
    public function jsonSerialize($data, array $serializationGroups): string
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $encoder = new JsonEncoder();
        $serializer = new \Symfony\Component\Serializer\Serializer([$normalizer], [$encoder]);

        return $serializer->serialize($data, 'json', ['groups' => $serializationGroups]);
    }
}