<p align="center">
    <a href="https://omegamvc.github.io" target="_blank">
        <img src="https://github.com/omegamvc/omega-assets/blob/main/images/logo-omega.png" alt="Omega Logo">
    </a>
</p>

<p align="center">
    <a href="https://omegamvc.github.io">Documentation</a> |
    <a href="https://github.com/omegamvc/omegamvc.github.io/blob/main/README.md#changelog">Changelog</a> |
    <a href="https://github.com/omegamvc/omega/blob/main/CONTRIBUTING.md">Contributing</a> |
    <a href="https://github.com/omegamvc/omega/blob/main/CODE_OF_CONDUCT.md">Code Of Conduct</a> |
    <a href="https://github.com/omegamvc/omega/blob/main/LICENSE">License</a>
</p>

# Validation & Filter

Build elegant validation on top of [(Wixel/GUMP)](https://github.com/Wixel/GUMP), one of the most popular php validation.

## Validation
```php
$val = new Validator($_POST);

$val->field('name')->required()->validName();
// or
$val->name->required()->validName();

$val->if_valid(function() {
    // continue
})->else(function($err) {
    // array of error messages
    var_dump($err);
});
```

### **GUMP support**
```php
$is_valid = GUMP::is_valid(array_merge($_POST, $_FILES), [
    'username' => vr()->required()->alpha_numeric(),
    'password' => vr()->required()->between_len(6, 100),
    'avatar'   => vr()->required_file()->extension('png', 'jpg')
]);

if ($is_valid === true) {
    // continue
} else {
    // array of error messages
    var_dump($is_valid);
}
```
### **Available method**

- `required()`
- `valid_email()`
- `max_len()`
- `min_len()`
- `exact_len()`
- `between_len()`
- `alpha()`
- `alpha_numeric()`
- `alpha_numeric_space()`
- `alpha_numeric_dash()`
- `alpha_dash()`
- `alpha_space()`
- `numeric()`
- `integer()`
- `boolean()`
- `float()`
- `valid_url()`
- `url_exists()`
- `valid_ip()`
- `valid_ipv4()`
- `valid_ipv6()`
- `guidv4()`
- `valid_cc()`
- `valid_name()`
- `contains()`
- `contains_list()`
- `doesnt_contain_list()`
- `street_address()`
- `date()`
- `min_numeric()`
- `max_numeric()`
- `min_age()`
- `invalid()`
- `starts()`
- `extension()`
- `required_file()`
- `equalsfield()`
- `iban()`
- `phone_number()`
- `regex()`
- `valid_json_string()`
- `valid_array_size_greater()`
- `valid_array_size_lesser()`
- `valid_array_size_equal()`

And
- `not()`, for invert all available method.
- `where($condition)`, execute rule if condition true.
- `if($condition)`, execute rule if condition true.

## Filter
Filter field input
```php
$val = new Validator($_POST);

$val->filter('name')->trim()->lowwer_case();

// run filter
$filter = $val->filter_out();
```
validation and filter
```php
$val = new Validator($_POST);

$val->field('name')->required()->valid_name();
$val->filter('name')->trim()->lowwer_case();

// run validation and filter
$filter = $val->failedOrFilter());
```

### **Why use Validator**
Why use validator over `GUMP` validator.
- Avoid typo when building validator rule. When using validator may accidentally type wrong validate rule (typo). It makes runtime error.
- Autocomplete out of the box. Auto complete validator rule and maintainable rule.
