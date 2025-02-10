<?php

namespace VeiligLanceren\MaakEenFactuur\Facades;

use Illuminate\Support\Facades\Facade;
use VeiligLanceren\MaakEenFactuur\Popo\CustomerPopo;

/**
 * @method static CustomerPopo[]|array all()
 * @method static CustomerPopo create(array $data)
 * @method static CustomerPopo find(int $customerId)
 *
 * @see \VeiligLanceren\MaakEenFactuur\Services\CustomerService
 */
class Customer extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'customer';
    }
}
