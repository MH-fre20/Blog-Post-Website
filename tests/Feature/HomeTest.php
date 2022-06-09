<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Hometest extends TestCase
{
    use RefreshDatabase;
    


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertSeeText('This is home.index');
    }

    public function test_contactTest()
    {
        $response = $this->get('/contact');
        $response->assertSeeText('This is home.contact');
    }

    public function test_singleTest()
    {
        $response = $this->get('/single');
        $response->assertSeeText('single');
    }

    public function test_singlity()
    {
        $hell = $this->get('/single');
        $hell->assertSeeText('single');
    }
}
