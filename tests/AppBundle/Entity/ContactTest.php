<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Contact;

class ContactTest extends \PHPUnit_Framework_TestCase {
    
    public function testSetTitle() {
        
        $Contact = new Contact();
        
        $title = "Wiadomość Testowa";
        $Contact->setTitle($title);
        
        $this->assertEquals($title, $Contact->getTitle());       
    }
    
    public function testSetEmail() {
        
        $Contact = new Contact();
        
        $email = "test@example.com";
        $Contact->setEmail($email);
        
        $this->assertEquals($email, $Contact->getEmail());
        
    }
    
}
