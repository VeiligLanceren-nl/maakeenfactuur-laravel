<?php

namespace VeiligLanceren\MaakEenFactuur\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Scrumble\Popo\BasePopo;
use VeiligLanceren\MaakEenFactuur\Exception\ApiErrorException;
use VeiligLanceren\MaakEenFactuur\Facades\Customer;
use VeiligLanceren\MaakEenFactuur\Popo\CustomerPopo;

class CustomerService
{
    /**
     * @return Collection<int, Customer>
     *
     * @throws ApiErrorException
     */
    public static function all(): Collection
    {
        $response = ApiService::get('/customers');

        return static::parseResponseToPopoArray($response, CustomerPopo::class);
    }

    /**
     * @throws ApiErrorException
     */
    public static function create(array $data): CustomerPopo
    {
        $response = ApiService::post('/customer/store', $data);

        return static::parseResponseToPopo($response, CustomerPopo::class);
    }

    /**
     * @throws ApiErrorException
     */
    public static function find(int $customerId): CustomerPopo
    {
        $response = ApiService::get("/customers/{$customerId}");

        return static::parseResponseToPopo($response, CustomerPopo::class);
    }

    protected static function parseResponseToPopo(Response $response, string $popoClass): CustomerPopo
    {
        /** @var array<string, mixed> $responseData */
        $responseData = $response->json();

        return new $popoClass($responseData);
    }

    /**
     * @return Collection<int, BasePopo>
     */
    protected static function parseResponseToPopoArray(Response $response, string $popoClass): Collection
    {
        $responseData = $response->json();
        $popos = Collection::make();

        foreach ($responseData as $data) {
            $popos->add(new $popoClass($data));
        }

        return $popos;
    }
}
