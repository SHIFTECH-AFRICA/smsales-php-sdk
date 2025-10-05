# <p align="center"><a href="https://smsales.co.ke" target="_blank"><img width="200" src="https://smsales.co.ke/assets/images/logo.png" alt="SMSALES Logo"></a></p>

<p align="center">
  <b>Always Delivering</b><br>
  <a href="https://github.com/SHIFTECH-AFRICA/smsales-php-sdk/issues">
    <img src="https://img.shields.io/github/issues/SHIFTECH-AFRICA/smsales-php-sdk.svg">
  </a>
  <a href="https://github.com/SHIFTECH-AFRICA/smsales-php-sdk/network/members">
    <img src="https://img.shields.io/github/forks/SHIFTECH-AFRICA/smsales-php-sdk.svg">
  </a>
  <a href="https://github.com/SHIFTECH-AFRICA/smsales-php-sdk/stargazers">
    <img src="https://img.shields.io/github/stars/SHIFTECH-AFRICA/smsales-php-sdk.svg">
  </a>
  <a href="https://packagist.org/packages/shiftechafrica/smsales-php-sdk">
    <img src="https://poser.pugx.org/shiftechafrica/smsales-php-sdk/v/stable">
  </a>
  <a href="https://packagist.org/packages/shiftechafrica/smsales-php-sdk">
    <img src="https://poser.pugx.org/shiftechafrica/smsales-php-sdk/downloads">
  </a>
  <br><br>
  <a href="https://docs.smsales.co.ke/"><img src="https://github.com/dev-techguy/TechGuy/blob/master/doc.png" width="200" alt="Documentation"></a>
</p>

---

## 🚀 Introduction

**SMSALES PHP SDK** provides a simple, developer-friendly interface for interacting with the **SMSALES API** — a powerful platform for sending and managing SMS communications.

This SDK enables seamless integration of SMS services into your Laravel or standalone PHP applications, helping you to:

- 📤 Send single or bulk SMS messages effortlessly
- 💰 Retrieve account and sender ID balances
- 📊 Receive delivery callbacks and monitor message status
- ⚙️ Automate messaging workflows with scheduling and webhooks

With SMSALES, you can focus on communication — while the SDK handles the complexity of SMS API interactions.

📘 **Official Documentation:** [https://docs.smsales.co.ke](https://docs.smsales.co.ke)

---

## ⚙️ Installation

Install the package using [Composer](https://getcomposer.org/):

```bash
composer require shiftechafrica/smsales-php-sdk
```

Update to the latest stable version:
```bash
composer update shiftechafrica/smsales-php-sdk --lock
```

If the package isn’t automatically discovered, run:
```bash
composer dump-autoload
```

Publish the configuration file:
```bash
php artisan vendor:publish --provider="SMSALES\SMSALEServiceProvider"
```

This will create the configuration file at:
```
config/smsales.php
```

### Environment Setup

Add your API token in the `.env` file:

```dotenv
# Your SMSALES API token
SMSALES_API_TOKEN=your_api_token_here
```

---

## 🧩 Usage

The SDK provides a clean and consistent interface for interacting with the SMSALES API.

### Example: Sending SMS and Checking Balances

```php
<?php

use SMSALES\API\Trigger;

/**
 * ----------------------------------------
 *  SMSALES SDK Usage Examples
 * ----------------------------------------
 * Demonstrates how to interact with the
 * SMSALES API for sending and tracking SMS.
 */

/**
 * Fetch latest sent messages
 */
(new Trigger())->index();

/**
 * Get account SMS balance
 */
(new Trigger())->accountSmsBalance();

/**
 * Get sender ID SMS balance
 */
(new Trigger())->senderIDSmsBalance();

/**
 * Send bulk SMS
 */
(new Trigger())->send([
    "api_sender" => "shiftech", // Required — must match your registered Sender ID
    "message" => "Hello from SMSALES!", // Required
    "phone_numbers" => ["2547XXXXXXXX", "2541XXXXXXXX", "2547XXXXXXXX"], // Required
    "scheduled_at" => "2025-12-01 10:00:00", // Optional (Y-m-d H:i:s format)
    "callback_url" => "https://yourdomain.com/sms/callback" // Optional (POST endpoint)
]);
```

---

## 📬 API Responses

### ✅ Successful Bulk SMS Request

```json
{
  "data": {
    "message": "Accepted for dispatch..."
  }
}
```

### 📡 Callback Report Example

```json
{
  "sent": true,
  "sender": "SHIFTECH",
  "apiSender": "shiftech",
  "phoneNumbers": [
    "254XXXXXXXXX",
    "254XXXXXXXXX",
    "254XXXXXXXXX"
  ],
  "batch": "1CRVD1GEXE",
  "account": {
    "smsBalance": "663",
    "smsUsage": "24"
  }
}
```

---

## 🧭 Version Guidance

| Version | Status  | Packagist | Namespace | Release |
|----------|----------|------------|------------|----------|
| **1.x** | ✅ Latest | `shiftechafrica/smsales-php-sdk` | `SMSALES` | [v1.2.0](https://github.com/SHIFTECH-AFRICA/smsales-php-sdk/releases/tag/v1.2.0) |

---

## 🛡️ Security Vulnerabilities

If you discover any security vulnerabilities, please contact:  
📧 **[Support](mailto:bugs@shiftech.co.ke)**

---

## 📄 License

This package is open-source software licensed under the  
**[MIT License](https://opensource.org/licenses/MIT)**
