<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact {
    
    /**
     * @Assert\NotBlank
     */
    private $sender;
    
    /**
     * @Assert\Email
     * @Assert\NotBlank
     */
    private $email;
    
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 50
     * )
     */
    private $title;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 500
     * )
     */    
    private $content;
    
    function getSender() {
        return $this->sender;
    }

    function getEmail() {
        return $this->email;
    }

    function getTitle() {
        return $this->title;
    }

    function getContent() {
        return $this->content;
    }

    function setSender($sender) {
        $this->sender = $sender;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setContent($content) {
        $this->content = $content;
    }
    
}
