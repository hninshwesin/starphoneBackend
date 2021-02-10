<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\BrandName;

class BrandNameApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_brand_name()
    {
        $brandName = BrandName::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/brand_names', $brandName
        );

        $this->assertApiResponse($brandName);
    }

    /**
     * @test
     */
    public function test_read_brand_name()
    {
        $brandName = BrandName::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/brand_names/'.$brandName->id
        );

        $this->assertApiResponse($brandName->toArray());
    }

    /**
     * @test
     */
    public function test_update_brand_name()
    {
        $brandName = BrandName::factory()->create();
        $editedBrandName = BrandName::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/brand_names/'.$brandName->id,
            $editedBrandName
        );

        $this->assertApiResponse($editedBrandName);
    }

    /**
     * @test
     */
    public function test_delete_brand_name()
    {
        $brandName = BrandName::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/brand_names/'.$brandName->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/brand_names/'.$brandName->id
        );

        $this->response->assertStatus(404);
    }
}
