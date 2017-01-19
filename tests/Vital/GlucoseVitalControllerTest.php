<?php

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Vital\GlucoseVitalController;
use App\Repositories\GlucoseVitalRepository;
use Illuminate\Database\Eloquent\Collection;
use Mockery\Mock;


class GlucoseVitalControllerTest extends TestCase
{
    /**
     * @var GlucoseVitalController
     */
    protected $target;

    /**
     * @var Mock GlucoseVitalRepository
     */
    protected $mockVitalRepos;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->mockVitalRepos = $this->initMock(GlucoseVitalRepository::class);
        $this->target = $this->app->make(GlucoseVitalController::class);
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown() {
        $this->target = null;
        $this->mock = null;
        parent::tearDown();
    }

    /**
     * Test GlucoseVitalController::index()
     *
     */
    public function testIndex() {
        // arrange
        $expectedSuccess = true;
        $expectedContent = [
            ['id'=>1, 'user_id'=>11 , 'value'=>110 , 'record_time'=>'2016-09-03 00:00:00'],
            ['id'=>2, 'user_id'=>11 , 'value'=>90  , 'record_time'=>'2016-09-21 11:00:00'],
            ['id'=>3, 'user_id'=>11 , 'value'=>120 , 'record_time'=>'2016-09-10 09:00:00']
        ];
        $this->mockVitalRepos->shouldReceive('getAll')
            ->once()
            ->withNoArgs()
            ->andReturn($expectedContent);

        // act
        $response = $this->target->index();
        $content = json_decode($response->getContent(),true);
        $actualSuccess = $content['success'];
        $actualContent = $content['result'];

        // assert
        $this->assertEquals($expectedSuccess, $actualSuccess);
        $this->assertEquals($expectedContent, $actualContent);
    }
    
    /**
     * Test GlucoseVitalController::show($id) which $id existed
     *
     */
    public function testShowIdExisted() {
        // arrange
        $targetId = 3;
        $expectedSuccess = true;
        $expectedContent = [
            'id'=>$targetId, 'user_id'=>11 , 'value'=>120 , 'record_time'=>'2016-09-10 09:00:00'
        ];
        $this->mockVitalRepos->shouldReceive('getById')
            ->once()
            ->with($targetId)
            ->andReturn($expectedContent);

        // act
        $response = $this->target->show($targetId);
        $content = json_decode($response->getContent(),true);
        $actualSuccess = $content['success'];
        $actualContent = $content['result'];

        // assert
        $this->assertEquals($expectedSuccess, $actualSuccess);
        $this->assertEquals($expectedContent, $actualContent);
    }
    
    /**
     * Test GlucoseVitalController::show($id) which $id is not existed
     *
     */
    public function testShowIdNotExisted() {
        // arrange
        $expectedSuccess = false;
        $expectedContent = [];
        $this->mockVitalRepos->shouldReceive('getById')
            ->once()
            ->withAnyArgs()
            ->andReturn($expectedContent);

        // act
        $response = $this->target->show(1);
        $content = json_decode($response->getContent(),true);
        $actualSuccess = $content['success'];
        $actualContent = $content['result'];

        // assert
        $this->assertEquals($expectedSuccess, $actualSuccess);
        $this->assertEquals($expectedContent, $actualContent);
    }
}
