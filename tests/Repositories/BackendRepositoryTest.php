<?php namespace Tests\Repositories;

use App\Models\Backend;
use App\Repositories\BackendRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BackendRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BackendRepository
     */
    protected $backendRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->backendRepo = \App::make(BackendRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_backend()
    {
        $backend = Backend::factory()->make()->toArray();

        $createdBackend = $this->backendRepo->create($backend);

        $createdBackend = $createdBackend->toArray();
        $this->assertArrayHasKey('id', $createdBackend);
        $this->assertNotNull($createdBackend['id'], 'Created Backend must have id specified');
        $this->assertNotNull(Backend::find($createdBackend['id']), 'Backend with given id must be in DB');
        $this->assertModelData($backend, $createdBackend);
    }

    /**
     * @test read
     */
    public function test_read_backend()
    {
        $backend = Backend::factory()->create();

        $dbBackend = $this->backendRepo->find($backend->id);

        $dbBackend = $dbBackend->toArray();
        $this->assertModelData($backend->toArray(), $dbBackend);
    }

    /**
     * @test update
     */
    public function test_update_backend()
    {
        $backend = Backend::factory()->create();
        $fakeBackend = Backend::factory()->make()->toArray();

        $updatedBackend = $this->backendRepo->update($fakeBackend, $backend->id);

        $this->assertModelData($fakeBackend, $updatedBackend->toArray());
        $dbBackend = $this->backendRepo->find($backend->id);
        $this->assertModelData($fakeBackend, $dbBackend->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_backend()
    {
        $backend = Backend::factory()->create();

        $resp = $this->backendRepo->delete($backend->id);

        $this->assertTrue($resp);
        $this->assertNull(Backend::find($backend->id), 'Backend should not exist in DB');
    }
}
