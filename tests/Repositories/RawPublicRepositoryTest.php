<?php namespace Tests\Repositories;

use App\Models\RawPublic;
use App\Repositories\RawPublicRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RawPublicRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RawPublicRepository
     */
    protected $rawPublicRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rawPublicRepo = \App::make(RawPublicRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_raw_public()
    {
        $rawPublic = RawPublic::factory()->make()->toArray();

        $createdRawPublic = $this->rawPublicRepo->create($rawPublic);

        $createdRawPublic = $createdRawPublic->toArray();
        $this->assertArrayHasKey('id', $createdRawPublic);
        $this->assertNotNull($createdRawPublic['id'], 'Created RawPublic must have id specified');
        $this->assertNotNull(RawPublic::find($createdRawPublic['id']), 'RawPublic with given id must be in DB');
        $this->assertModelData($rawPublic, $createdRawPublic);
    }

    /**
     * @test read
     */
    public function test_read_raw_public()
    {
        $rawPublic = RawPublic::factory()->create();

        $dbRawPublic = $this->rawPublicRepo->find($rawPublic->id);

        $dbRawPublic = $dbRawPublic->toArray();
        $this->assertModelData($rawPublic->toArray(), $dbRawPublic);
    }

    /**
     * @test update
     */
    public function test_update_raw_public()
    {
        $rawPublic = RawPublic::factory()->create();
        $fakeRawPublic = RawPublic::factory()->make()->toArray();

        $updatedRawPublic = $this->rawPublicRepo->update($fakeRawPublic, $rawPublic->id);

        $this->assertModelData($fakeRawPublic, $updatedRawPublic->toArray());
        $dbRawPublic = $this->rawPublicRepo->find($rawPublic->id);
        $this->assertModelData($fakeRawPublic, $dbRawPublic->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_raw_public()
    {
        $rawPublic = RawPublic::factory()->create();

        $resp = $this->rawPublicRepo->delete($rawPublic->id);

        $this->assertTrue($resp);
        $this->assertNull(RawPublic::find($rawPublic->id), 'RawPublic should not exist in DB');
    }
}
