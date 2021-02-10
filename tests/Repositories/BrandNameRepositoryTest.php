<?php namespace Tests\Repositories;

use App\Models\BrandName;
use App\Repositories\BrandNameRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BrandNameRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BrandNameRepository
     */
    protected $brandNameRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->brandNameRepo = \App::make(BrandNameRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_brand_name()
    {
        $brandName = BrandName::factory()->make()->toArray();

        $createdBrandName = $this->brandNameRepo->create($brandName);

        $createdBrandName = $createdBrandName->toArray();
        $this->assertArrayHasKey('id', $createdBrandName);
        $this->assertNotNull($createdBrandName['id'], 'Created BrandName must have id specified');
        $this->assertNotNull(BrandName::find($createdBrandName['id']), 'BrandName with given id must be in DB');
        $this->assertModelData($brandName, $createdBrandName);
    }

    /**
     * @test read
     */
    public function test_read_brand_name()
    {
        $brandName = BrandName::factory()->create();

        $dbBrandName = $this->brandNameRepo->find($brandName->id);

        $dbBrandName = $dbBrandName->toArray();
        $this->assertModelData($brandName->toArray(), $dbBrandName);
    }

    /**
     * @test update
     */
    public function test_update_brand_name()
    {
        $brandName = BrandName::factory()->create();
        $fakeBrandName = BrandName::factory()->make()->toArray();

        $updatedBrandName = $this->brandNameRepo->update($fakeBrandName, $brandName->id);

        $this->assertModelData($fakeBrandName, $updatedBrandName->toArray());
        $dbBrandName = $this->brandNameRepo->find($brandName->id);
        $this->assertModelData($fakeBrandName, $dbBrandName->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_brand_name()
    {
        $brandName = BrandName::factory()->create();

        $resp = $this->brandNameRepo->delete($brandName->id);

        $this->assertTrue($resp);
        $this->assertNull(BrandName::find($brandName->id), 'BrandName should not exist in DB');
    }
}
