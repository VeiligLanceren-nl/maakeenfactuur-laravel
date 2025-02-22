<?php

namespace VeiligLanceren\MaakEenFactuur\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Scrumble\Popo\BasePopo;
use VeiligLanceren\MaakEenFactuur\Exception\ApiErrorException;
use VeiligLanceren\MaakEenFactuur\Popo\InvoicePopo;

class InvoiceService
{
    /**
     * @throws ApiErrorException
     */
    public static function create(array $data): InvoicePopo
    {
        /** @var Response $response */
        $response = ApiService::post('/invoice/store', $data);

        return static::parseResponseToPopo($response, InvoicePopo::class);
    }

    /**
     * @throws ApiErrorException
     */
    public static function update(int $invoiceId, array $data): InvoicePopo
    {
        $response = ApiService::put("/invoice/{$invoiceId}/update", $data);

        return static::parseResponseToPopo($response, InvoicePopo::class);
    }

    /**
     * @return Collection<int, InvoicePopo>
     *
     * @throws ApiErrorException
     */
    public static function all(): Collection
    {
        $response = ApiService::get('/invoices');

        return static::parseResponseToPopoArray($response, InvoicePopo::class);
    }

    /**
     * @throws ApiErrorException
     */
    public static function find(int $invoiceId): InvoicePopo
    {
        /** @var Response $response */
        $response = ApiService::get("/invoice/{$invoiceId}");

        return new InvoicePopo($response->json());
    }

    /**
     * @throws ApiErrorException
     */
    public static function pdf(int $invoiceId): Response
    {
        /** @var Response $response */
        $response = ApiService::get("/invoice/{$invoiceId}/pdf");

        return $response;
    }

    protected static function parseResponseToPopo(Response $response, string $popoClass): InvoicePopo
    {
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
