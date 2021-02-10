<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Public;

class PublicApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_public()
    {
        $public = Public::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/publics', $public
        );

        $this->assertApiResponse($public);
    }

    /**
     * @test
     */
    public function test_read_public()
    {
        $public = Public::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/publics/'.$public->id
        );

        $this->assertApiResponse($public->toArray());
    }

    /**
     * @test
     */
    public function test_update_public()
    {
        $public = Public::factory()->create();
        $editedPublic = Public::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/publics/'.$public->id,
            $editedPublic
        );

        $this->assertApiResponse($editedPublic);
    }

    /**
     * @test
     */
    public function test_delete_public()
    {
        $public = Public::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/publics/'.$public->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/publics/'.$public->id
        );

        $this->response->assertStatus(404);
    }
}
