<?php

namespace Gyvex\MaakEenFactuur\Popo;

use Scrumble\Popo\BasePopo;

class InvoicePopo extends BasePopo
{
    public int $id;

    public int $user_id;

    public string $invoice_number;

    public string $date;

    public string $due_date;

    public float $total_amount;

    public string $status;

    /**
     * @var array<InvoiceItemPopo>|null
     */
    public ?array $items;

    /**
     * @param array $jsonData
     */
    public function __construct(array $jsonData)
    {
        $this->id = $jsonData['id'];
        $this->user_id = $jsonData['user_id'];
        $this->invoice_number = $jsonData['invoice_number'];
        $this->date = $jsonData['date'];
        $this->due_date = $jsonData['due_date'];
        $this->total_amount = $jsonData['total_amount'];
        $this->status = $jsonData['status'];
        $this->items = [];

        foreach ($jsonData['items'] as $item) {
            $this->items[] = new InvoiceItemPopo(
                $item['id'],
                $item['description'],
                $item['quantity'],
                $item['unit_price'],
                $item['total_price'],
                $item['vat_percentage'],
            );
        }
    }
}
