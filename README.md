# MaakEenFactuur.nl Laravel package

![Maak Een Factuur Laravel API](/favicon.png)

📜 **Overview**  
This Laravel package is a PHP library that provides simplified interfaces for managing customers and invoices via our API. It includes two primary facades: `Customer` and `Invoice`, which are backed by powerful service classes handling all interactions with the API.

- **Website**: [MaakEenFactuur.nl](https://maakeenfactuur.nl)
- **Documentatie**: [API documentatie](https://api.maakeenfactuur.nl/)
- **Supported Laravel versions**: 10, 11
- **Supported PHP versions**: > 8.2

## Features

- **Customer management**: Retrieve, create, and manage customer information.
- **Invoice processing**: Create, update, and fetch invoices.
- **Exception handling**: Error management to handle API responses.

![Veilig Lanceren](/veilig-lanceren-logo.png)

This package is maintained by VeiligLanceren.nl, your partner in website development and everything else to power up your online company. More information available on [our website](https://veiliglanceren.nl).

## Installation

To use the Laravel package of MaakEenFactuur.nl in your project, require it via Composer in your terminal:

```bash
composer require veiliglanceren/maakeenfactuur-laravel
```

## Configuration

The API key is handled by the `ApiService` of the package. Set up your API key to authenticate requests.

By default this will be loaded from the config file `config/maakeenfactuur.php` which can be exported by running:

```bash
php artisan vendor:publish --tag="maakeenfactuur-config"
```

This will add the default `.env` variable `MAAKEENFACTUUR_API_KEY` which can be set:

```
MAAKEENFACTUUR_API_KEY="YOUR_API_KEY"
```

## Usage

### Managing Customers

```php
use VeiligLanceren\MaakEenFactuur\Facades\Customer;

// Fetch all customers
$customers = Customer::all();

// Create a new customer
$newCustomer = Customer::create(['name' => 'John Doe', 'email' => 'john@example.com']);

// Find a specific customer
$customer = Customer::find(1);
```

### Handling Invoices

```php
use VeiligLanceren\MaakEenFactuur\Facades\Invoice;

// Create an invoice
$newInvoice = Invoice::create(['customer_id' => 1, 'amount' => 100.00]);

// Update an existing invoice
$updatedInvoice = Invoice::update(1, ['amount' => 150.00]);

// Fetch all invoices
$invoices = Invoice::all();

// Find a specific invoice
$invoice = Invoice::find(1);
```

## Handling API Errors

Both `Customer` and `Invoice` services throw an `ApiErrorException` if an API request fails, allowing you to handle errors gracefully in your application.

```php
try {
    $invoice = Invoice::find(1);
} catch (VeiligLanceren\MaakEenFactuur\Exception\ApiErrorException $e) {
    // TODO: Handle error
    echo 'Error: ' . $e->getMessage();
}
```

## Contributing

Contributions are welcome! Please feel free to submit a pull request or create an issue if you have any suggestions or find any bugs.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details.

This README is structured to provide a comprehensive introduction and guide on how to use the library, complete with installation instructions, usage examples, and basic error handling. Adjust the details according to your actual project structure and requirements.
