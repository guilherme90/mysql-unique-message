# MySQL Unique Message

A simple library for formatting the duplicate message in MySQL

- PHP >= 7

### Tests
```bash
$ composer test
```

### PSR-2
```bash
$ composer cs
$ composer csfix
```

### How to use
```php
<?php

use \MySQLUniqueMessage\UniqueMessage;

// This message will return in your mysql using try / catch block
$message = 'SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry \'user@provider.com\' for key \'email\'';
$output = UniqueMessage::format($message); 
```

Dump from `$output`
```
[
	'name' => 'email',
	'value' => 'user@provider.com',
	'message' => 'The email \'user@provider.com\' is already registered.'
];
```

Enjoy!
