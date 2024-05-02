
![Logo](https://repository-images.githubusercontent.com/795007219/f6c83903-f960-4812-9d99-e1adf7181c6d)


# E-Wallet Payment Gateway (Client)

This code is intended solely for client use and only functions on the Rootscratch server. If you do not have access to a Rootscratch server, this code will not be useful. To inquire about server access, please contact me at jaycee@rootscratch.com. This code facilitates the creation and reading of e-wallet transactions. Additionally, this gateway is supported by Xendit PH.

https://rootscratch.com/
## 🧬 Installation

```bash
git clone https://github.com/jaycee0610/E-Wallet-Gateway-client.git
cd E-Wallet-Gateway-client
```
    
## 🤖 Features

- Create Transactions
- Get Transaction Details
- Webhook



## 💳 Here is the List of Available E-Wallet Merchants
| Merchant | Channel Code                          |
|-------------------|--------------------------------------|
| GCash             | PH_GCASH |
| PayMaya           | PH_PAYMAYA |
| ShopeePay          | PH_SHOPEEPAY |
| GrabPay           | PH_GRABPAY |

## 📢 Transaction Limits
|Min. Amount | Max. Amount|
|-------------------|--------------------------------------|
|1 PHP | based on eWallet holding limit

## 🔔 Transaction Status
| Status Type | Details                         |
|-------------------|--------------------------------------|
| SUCCEEDED             | Payment transaction for specified ``id`` is successfully |
| PENDING             | Payment transaction for specified ``id`` is awaiting payment attempt by end user |
| FAILED             | Payment transaction for specified ``id`` has failed, check failure codes for reasons |
| VOIDED             | Payment transaction for specified ``id`` has been voided |
| REFUNDED             | Payment transaction for specified ``id`` has been either partially or fully refunded |

## 📌 Create Transactions

Sample Request to send. ``/createCharges``

```json
{
    "api_key": "api_key",
    "reference_id": "order-id-123",
    "currency": "PHP",
    "amount": 25000,
    "channel_code": "PH_GCASH",
    "channel_properties": {
        "success_redirect_url": "https://yourwebsite.me/payment",
        "failure_redirect_url": "https://yourwebsite.me/failed",
        "cancel_redirect_url": "https://yourwebsite.me/cancelled",
        "pending_redirect_url": "https://yourwebsite.me/pending"
    }
}
```

Sample Response
> [!CAUTION]
> Please save the 'ID' or include it in your database for future reference regarding your transaction.

```json
{
    "reference_id": "order-id-123",
    "status": "PENDING",
    "charge_amount": 25000,
    "currency": "PHP",
    "method": "PH_GCASH",
    "payment_url": "URL",
    "created_date": "2024-04-25T06:28:33.296238Z",
    "id": "c0f9350ceb435bd92d5228a748b1ab6a"
}
```

## 📌 Get Transaction Details
Sample Request to send. ``/getStatus``

```json
{
    "api_key": "your_api_key",
    "id": "363nn3978s0034bbv22909"
}
```
Sample Response
```json
{
    "id": "363nn3978s0034bbv22909",
    "transaction_type": "live",
    "reference_id": "order-id-123",
    "transaction_amount": "25000.00",
    "payment_url": "https://payments.gcash.com/gcash-cashier-web/1.2.1/..",
    "method": "PH_GCASH",
    "status": "PENDING",
    "created_date": "2024-04-25 07:38:56"
}
```

## 📌 Webhook Payload to Receive
``/getResponse``
```json
{
    "id": "363nn3978s0034bbv22909",
    "transaction_type": "live",
    "reference_id": "order-id-123",
    "transaction_amount": "25000.00",
    "payment_url": "https://payments.gcash.com/gcash-cashier-web/1.2.1/..",
    "method": "PH_GCASH",
    "status": "SUCCEEDED",
    "created_date": "2024-04-25 07:38:56"
}
```
## Authors

- [@jaycee0610](https://github.com/jaycee0610)
- [@jsonabinon12](https://github.com/jsonabinon12)


## Support

For support, please email me at jaycee@rootscratch.com.
