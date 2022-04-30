<?php

namespace App\Entity\Template;

class Template implements TemplateInterface
{
    public $id;
    public $subject;
    public $content;

    public function __construct(int $id, string $subject, string $content) {
        $this->id = $id;
        $this->subject = $subject;
        $this->content = $content;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getSubject(): string {
        return $this->subject;
    }

    public function getContent(): string {
        return $this->content;
    }
}
