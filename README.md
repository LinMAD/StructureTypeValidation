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
