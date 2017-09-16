## Structure Type Validation

    Light and simple structure validator. Do validation of yours structures as expected.

#### Where to use
Generally, if need to work with huge or complex structures and to be sure the needed data exist and value types are as expected.
For example, you work with some API. Your system receives structure, the you must it validate and ways of that is different.
One of that way is my, you can create a list of mandatory keys and types to validate structure.
It' allows you to cut of wrong work, before executing heavy manipulation with data, for example serialization to object.

### How it works
Analyzer will compare your structure with your structure mapping with strict types.
Then if it founds some mismatches it will put error to bucket and after process you can view errors in bucket.
In the end, you will receive a boolean and from that you can understand if structure valid as expected mapping.


#### TODO :thinking:
- Add diagram of algorithm for better explanation
- Add coveralls
- Add Travis CI
