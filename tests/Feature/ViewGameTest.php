<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewGameTest extends TestCase
{
    /** @test */
    public function test_the_game_page_shows_correct_game_info()
    {
        $response = $this->get(route('games.show', 'the-last-of-us-part-ii'));

        $response->assertSuccessful();
    }
}
