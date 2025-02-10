<?php

namespace VeiligLanceren\MaakEenFactuur\Facades;

use Illuminate\Support\Facades\Facade;
use VeiligLanceren\MaakEenFactuur\Popo\InvoicePopo;

/**
 * @method static InvoicePopo[]|array all()
 * @method static InvoicePopo create(array $data)
 * @method static InvoicePopo update(int $invoiceId, array $data)
 * @method static InvoicePopo find(int $invoiceId)
 *
 * @see \VeiligLanceren\MaakEenFactuur\Services\InvoiceService
 */
class Invoice extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'invoice';
    }
}
