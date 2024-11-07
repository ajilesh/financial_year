<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Financial Year Details

Develop a single-page Laravel application that provides the financial year based on the selected year
and country (UK or Ireland). Additionally, integrate a public holidays API to display holidays occurring
within the financial year, excluding weekends (Saturday and Sunday).

## Installation

Clone the repository and navigate into the project folder:

1. Clone the repository:

    ```bash
    git clone https://github.com/ajilesh/financial_year.git
    ```

2. Navigate to the project directory:

    ```bash
    cd your-repository
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Access the application at `http://localhost:8000`(php artisan serve --port=8000)

   ## Notice
Api is not proper
Response :  {"error":{"message":"You can only query individual days on a free plan, not months or years. You must upgrade to make broader queries.","code":"payment_required","details":null}}

