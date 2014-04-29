<?php

use Symfony\Component\DomCrawler\Crawler;

class PostControllerTest extends TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        /** @var Crawler $crawler */
        $crawler = $this->client->request('GET', '/');

        $crawler->
        $this->assertTrue($this->client->getResponse()->isOk());
    }

}