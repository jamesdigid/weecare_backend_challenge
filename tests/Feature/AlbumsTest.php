<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlbumsTest extends TestCase
{
    public function testGetAlbums() {
        $response = $this->json('GET','/api/v1/albums');
        $this->assertEquals(100, count($response->getOriginalContent()));
    }


}
