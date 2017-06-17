# php-kv
use sqlite as key-value store.

## install

```
composer require lvht/kv
```

## usage
```
<?php
$kv = \Lvht\Key\Key::new('path/to/file.db');
// $kv = \Lvht\Key\Key::new('path/to/file.db', 'text');

$kv->set('a', [1,2,3]);

var_dump($kv->get('a'));
```
The output is
```
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  [2]=>
  int(3)
}
```
