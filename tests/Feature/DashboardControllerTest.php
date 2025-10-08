<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
        public function test_calculo_ganancias_mes()
        {
            $total = \App\Models\Payment::factory()->count(5)->create()->sum('amount');
            $this->assertEquals($total, Payment::sum('amount'));
        }
}
