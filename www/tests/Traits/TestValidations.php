<?php declare(strict_types=1);

namespace Tests\Traits;

use Illuminate\Foundation\Testing\TestResponse;

trait TestValidations
{
    abstract protected function model();

    abstract protected function routeStore();

    abstract protected function routeUpdate();

    protected function assertInvalidationInStoreAction(
        array $data,
        string $rule,
        $ruleParams = []
    ) {
        $response = $this->json('POST', $this->routeStore(), $data);
        $fields = array_keys($data);
        $this->assertInvalidationFields($response, $fields, $rule, $ruleParams);
    }

    protected function assertInvalidationInUpdateAction(
        array $data,
        string $rule,
        $ruleParams = []
    ) {
        $response = $this->json('PUT', $this->routeUpdate(), $data);
        $fields = array_keys($data);
        $this->assertInvalidationFields($response, $fields, $rule, $ruleParams);
    }

    protected function assertInvalidationFields(
        TestResponse $response,
        array $fields,
        string $rule,
        array $ruleParams = []
    ) {
        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors($fields);

        foreach ($fields as $field) {
            $field = str_replace('_', ' ', $field);
            $response->assertJsonFragment([
                trans("validation.{$rule}", ['attribute' => $field] + $ruleParams)
            ]);
        }
    }
}
