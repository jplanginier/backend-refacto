<?php

namespace App\Entity\Template;

interface TemplateInterface
{
    public function getId(): int;

    public function getSubject(): string;

    public function getContent(): string;
}