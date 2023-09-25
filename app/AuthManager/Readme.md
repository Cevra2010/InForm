# Inform - AuthManager

## Usage

Register the AuthMethod in ServiceProvider
```php
    public function boot(): void
    {
        AuthRegistry::register('login',DefaultLogin::class);
    }
```

Configure the AuthMethod
```php
class DefaultLogin implements AuthInterface {
    public static function getName() : string
    {
        return "Default";
    }

    public static function getView() : string {
        return "auth.login";
    }
}
```
