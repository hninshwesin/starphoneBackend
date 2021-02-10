<?php namespace Tests\Repositories;

use App\Models\Public;
use App\Repositories\PublicRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PublicRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PublicRepository
     */
    protected $publicRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->publicRepo = \App::make(PublicRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_public()
    {
        $public = Public::factory()->make()->toArray();

        $createdPublic = $this->publicRepo->create($public);

        $createdPublic = $createdPublic->toArray();
        $this->assertArrayHasKey('id', $createdPublic);
        $this->assertNotNull($createdPublic['id'], 'Created Public must have id specified');
        $this->assertNotNull(Public::find($createdPublic['id']), 'Public with given id must be in DB');
        $this->assertModelData($public, $createdPublic);
    }

    /**
     * @test read
     */
    public function test_read_public()
    {
        $public = Public::factory()->create();

        $dbPublic = $this->publicRepo->find($public->id);

        $dbPublic = $dbPublic->toArray();
        $this->assertModelData($public->toArray(), $dbPublic);
    }

    /**
     * @test update
     */
    public function test_update_public()
    {
        $public = Public::factory()->create();
        $fakePublic = Public::factory()->make()->toArray();

        $updatedPublic = $this->publicRepo->update($fakePublic, $public->id);

        $this->assertModelData($fakePublic, $updatedPublic->toArray());
        $dbPublic = $this->publicRepo->find($public->id);
        $this->assertModelData($fakePublic, $dbPublic->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_public()
    {
        $public = Public::factory()->create();

        $resp = $this->publicRepo->delete($public->id);

        $this->assertTrue($resp);
        $this->assertNull(Public::find($public->id), 'Public should not exist in DB');
    }
}
