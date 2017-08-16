<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {
    
    public function testPost() {
        $client = static::createClient();
        
        $data = array(
            'sender' => 'Test',
            'email' => 'test@example.com',
            'title' => 'Test Title',
            'content' => 'Lorem ipsum'
        );
        
        $request = $client->post('/send', null, json_encode($data));
        $request->send();
        
        $this->assertEquals(200, $request->getStatusCode());
    }
    
}
