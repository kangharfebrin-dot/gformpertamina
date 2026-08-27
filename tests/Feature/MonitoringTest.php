<?php

namespace Tests\Feature;

use App\Models\MonitoringResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MonitoringTest extends TestCase
{
    use RefreshDatabase;

    public function test_monitoring_form_can_be_rendered(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('1. Cilacap');
        $response->assertSee('2. Kroya');
        $response->assertSee('3. Purwokerto');
    }

    public function test_can_submit_monitoring_form_with_valid_location(): void
    {
        $data = [
            'email_address' => 'operator.test@pertamina.com',
            'tanggal'       => '2026-08-27',
            'lokasi'        => 'Cilacap',
            'stok_awal_mm'  => 4000,
        ];

        $response = $this->post('/submit', $data);
        $response->assertRedirect(route('monitoring.success'));

        $this->assertDatabaseHas('monitoring_responses', [
            'email_address' => 'operator.test@pertamina.com',
            'lokasi'        => 'Cilacap',
        ]);
    }

    public function test_responses_page_displays_and_filters_by_location(): void
    {
        MonitoringResponse::create([
            'email_address' => 'cilacap@pertamina.com',
            'tanggal'       => '2026-08-27',
            'lokasi'        => 'Cilacap',
        ]);

        MonitoringResponse::create([
            'email_address' => 'kroya@pertamina.com',
            'tanggal'       => '2026-08-27',
            'lokasi'        => 'Kroya',
        ]);

        $response = $this->get('/responses?lokasi=Cilacap');
        $response->assertStatus(200);
        $response->assertSee('cilacap@pertamina.com');
        $response->assertDontSee('kroya@pertamina.com');
    }
}
