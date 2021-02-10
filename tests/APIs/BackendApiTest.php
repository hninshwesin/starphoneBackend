<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Backend;

class BackendApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_backend()
    {
        $backend = Backend::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/backends', $backend
        );

        $this->assertApiResponse($backend);
    }

    /**
     * @test
     */
    public function test_read_backend()
    {
        $backend = Backend::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/backends/'.$backend->id
        );

        $this->assertApiResponse($backend->toArray());
    }

    /**
     * @test
     */
    public function test_update_backend()
    {
        $backend = Backend::factory()->create();
        $editedBackend = Backend::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/backends/'.$backend->id,
            $editedBackend
        );

        $this->assertApiResponse($editedBackend);
    }

    /**
     * @test
     */
    public function test_delete_backend()
    {
        $backend = Backend::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/backends/'.$backend->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/backends/'.$backend->id
        );

        $this->response->assertStatus(404);
    }
}
