# Helper

```php
$wp = \LumenPress\Helper::wrap(['wp_', 'wp_get_'], [
    
]);

$is = \LumenPress\Helper::wrap(['is_', 'wp_is_'], [
    'php' => true,
]);

wp_head();
// equals
$wp->head; // execute only once
$wp->head(); // execute every time

wp_is_mobile();
// equals
$is->mobile;
$is->mobile();
```
