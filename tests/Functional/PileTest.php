<?php
/**
 * Created by PhpStorm.
 * User: danbr
 * Date: 4/9/2019
 * Time: 10:28 AM
 */

namespace Tests\Functional;


class PileTest extends BaseTestCase
{
    public function testGetPiles(){
        $response = $this->runApp('GET', '/piles');

        $this->assertEquals(200, $response->getStatusCode());

        $body = (string)$response->getBody();
        $this->assertJson($body);

        $piles = json_decode($body);
        foreach($piles as $pile){
            //print_r($pile);
            $this->assertObjectHasAttribute('id', $pile);
            $this->assertObjectHasAttribute('name', $pile);
            $this->assertObjectHasAttribute('stacks', $pile);
        }

    }
}