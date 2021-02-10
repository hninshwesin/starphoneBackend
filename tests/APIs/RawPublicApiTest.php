<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\RawPublic;

class RawPublicApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_raw_public()
    {
        $rawPublic = RawPublic::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/raw_publics', $rawPublic
        );

        $this->assertApiResponse($rawPublic);
    }

    /**
     * @test
     */
    public function test_read_raw_public()
    {
        $rawPublic = RawPublic::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/raw_publics/'.$rawPublic->id
        );

        $this->assertApiResponse($rawPublic->toArray());
    }

    /**
     * @test
     */
    public function test_update_raw_public()
    {
        $rawPublic = RawPublic::factory()->create();
        $editedRawPublic = RawPublic::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/raw_publics/'.$rawPublic->id,
            $editedRawPublic
        );

        $this->assertApiResponse($editedRawPublic);
    }

    /**
     * @test
     */
    public function test_delete_raw_public()
    {
        $rawPublic = RawPublic::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/raw_publics/'.$rawPublic->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/raw_publics/'.$rawPublic->id
        );

        $this->response->assertStatus(404);
    }
}
