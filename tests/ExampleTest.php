<?php

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     */
    public function testBasicExample(): void
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
