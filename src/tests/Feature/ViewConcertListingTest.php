<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class ViewConcertListingTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    // @test
    public function testCanViewAConcertListing()
    {
        $this->withoutExceptionHandling();
        Concert::factory()->create([
            'title' => 'some title',
            'subtitle' => 'some subtitle',
            'date' => $date = Carbon::now(),
            'venue' => 'some venue',
            'venue_address' => 'address',
            'price' => 15550,
            'city' => 'cairo',
            'state' => 'ON',
            'zip' => 15311,
            'additional_information' => 'no info',
        ]);
        $response = $this->get(route('concert.view'));
        $response->assertSee('some title');
        $response->assertSee('some subtitle');
        $response->assertSee($date);
        $response->assertSee('some venue');
        $response->assertSee(15550);
        $response->assertSee('address');
        $response->assertSee('cairo');
        $response->assertSee('ON');
        $response->assertSee('no info');
    }
}
