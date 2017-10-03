## Structure Type Validation
[![Build Status](https://travis-ci.org/LinMAD/StructureTypeValidation.svg?branch=master)](https://travis-ci.org/LinMAD/StructureTypeValidation)
[![Coverage Status](https://coveralls.io/repos/github/LinMAD/StructureTypeValidation/badge.svg?branch=master)](https://coveralls.io/github/LinMAD/StructureTypeValidation?branch=master)

    Light and simple structure validator. Do validation of yours structures as expected.

#### Where to use
Generally, if need to work with huge or complex structures and need to be sure the key and value types exist as expected.
For example, you work with some API. Your system receives structure, the you must it validate and ways of that is different.
One of that way is my, you can create a list of mandatory keys and types to validate structure.
It' allows you to cut of wrong work, before executing heavy manipulation with data, for example serialization to object.

### How it works
Analyzer will compare your structure with your structure mapping with strict types.
Then if it founds some mismatches it will put error to bucket and after process you can view errors in bucket.
In the end, you will receive a boolean and from that you can understand if structure valid as expected mapping.

In other words, it simply walks in your tree and checks needed keys exist and value type are correct.

### Example of usage
For example, for your needs given some data in structure:
```php
$paymentReq = '{
    "amount": 10500,
    "ccy": "EUR",
    "account_id": 42,
    "order_description": "facere repellat provident occaecati excepturi optio reprehenderit"
}';
```

And you want to use like "schema", "map" or "structure" to overlay it. For example your map:
```php
$payementReqMap = [
    'amount' => 'integer',
    'ccy' => 'string',
    'account_id' => 'integer'
];
```
So, in your structure map key "order_description" not mandatory and you can accept it or skip. 
But others keys are strict and mandatory, so you didn't allow pass invalid data to your system.

```php
// Create instance
$analyzer = new Analyzer();

// Check if structure same as expected in map
$isValid = $analyzer->isValidStructure($paymentReq, $payementReqMap); // return bool, valid or not as expected

if ($isValid) {
    // Make some magic
    $this->paymentProvider->takeRequest($paymentReq);
}
// Or use other magic
```
