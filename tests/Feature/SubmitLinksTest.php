<?php

namespace Tests\Feature;

use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitLinksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_submit_a_new_link()
    {
        $response = $this->post('/submit', [
            'title' => 'Example Title',
            'url' => 'http://example.com',
            'description' => 'Example description.',
        ]);

        $this->assertDatabaseHas('links', [
            'title' => 'Example Title'
        ]);

        $response
            ->assertStatus(302)
            ->assertHeader('Location', url('/'));

        $this
            ->get('/')
            ->assertSee('Example Title');
    }
    // function link_is_not_created_if_validation_fails() {}
    // function link_is_not_created_with_an_invalid_url() {}
    // function max_length_fails_when_too_long() {}
    // function max_length_succeeds_when_under_max() {}
}
