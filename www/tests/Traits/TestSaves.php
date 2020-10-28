<?php declare(strict_types=1);

namespace Tests\Traits;

use Illuminate\Foundation\Testing\TestResponse;
use Exception;

trait TestSaves
{
    abstract protected function model();

    abstract protected function routeStore();

    abstract protected function routeUpdate();

    protected function assertStore(array $sendData, array $testDbData, array $testJsonData = null): TestResponse
    {
        $response = $this->json('POST', $this->routeStore(), $sendData);
        if ($response->status() !== 201) {
            throw new Exception("Response status must be 201, given {$response->status()}:\n{$response->content()}");
        }
        $this->assertInDatabase($response, $testDbData);
        $this->assertJsonReponseContent($response, $testDbData, $testJsonData);
        return $response;
    }

    protected function assertUpdate(array $sendData, array $testDbData, array $testJsonData = null): TestResponse
    {
        $response = $this->json('PUT', $this->routeUpdate(), $sendData);
        if ($response->status() !== 200) {
            throw new Exception("Response status must be 200, given {$response->status()}:\n{$response->content()}");
        }
        $this->assertInDatabase($response, $testDbData);
        $this->assertJsonReponseContent($response, $testDbData, $testJsonData);
        return $response;
    }

    private function assertInDatabase(TestResponse $response, array $testDbData)
    {
        $model = $this->model();
        $table = (new $model)->getTable();
        $this->assertDatabaseHas($table, $testDbData + ['id' => $response->json('id')]);
    }

    private function assertJsonReponseContent(TestResponse $response, array $testDbData, array $testJsonData = null)
    {
        $testResponse = $testJsonData ?? $testDbData;
        $response->assertJsonFragment($testResponse + ['id' => $response->json('id')]);
    }
}
