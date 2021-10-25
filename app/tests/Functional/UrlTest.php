<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class UrlTest extends ApiTestCase
{
    // This AliceBundle trait will empty the database content before every test call
    use ReloadDatabaseTrait;

    public function setUp(): void
    {
        self::bootKernel();
    }

    public function testGetUrl()
    {
        $client = self::createClient(); //anonymus user

        $client->request('GET', '/api/urls',
            ['headers' => ['Content-Type' => 'application/json']]);
        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostUrl()
    {
        $testUrl = "http://www.google.com";

        $client = self::createClient(); //anonymus user

        /** invalid POST params (bad request) */
        $client->request('POST', '/api/urls',
            [
                'headers'   => ['Content-Type' => 'application/json'],
                'json'      => []
            ]);
        $this->assertResponseStatusCodeSame(422);

        $client = self::createClient(); //anonymus user

        /** invalid POST params (bad request - url needs to have protocol at the beginning - for example 'http://') */
        $client->request('POST', '/api/urls',
            [
                'headers'   => ['Content-Type' => 'application/json'],
                'json'      => [
                    'longUrl'     => 'google.com',
                ]
            ]);
        $this->assertResponseStatusCodeSame(422);

        /** valid POST params, shortCode created */
        $response = $client->request('POST', '/api/urls',
            [
                'headers'   => ['Content-Type' => 'application/json'],
                'json'      => [
                    'longUrl'     => $testUrl,
                ]
            ]);
        $this->assertResponseStatusCodeSame(201); //created
        $data = $response->toArray();
        $shortCode = $data['shortCode'];
        $this->assertEquals(10, strlen($shortCode)); //short code for url is created and its length is 10

        /** Check redirection for the specific param */
        $response = $client->request('GET', '/' . $shortCode, []);
        $this->assertResponseStatusCodeSame(302); //redirect

        $this->assertEquals($response->getKernelResponse()->getTargetUrl(), $testUrl); //check value of redirect url
    }

}
