# Sluggish

Sluggish is a laravel library package for generating unique slug, custom slug, unique id, uuid, sequential number with prefix.

## Installation

Use the package run the following command.

```bash
composer require laravel-pulse/sluggish
```

## configuration

Add the following code inside providers.

```bash
LaravelPulse\Sluggish\SluggishServiceProvider::class
```
Publish connfig.php run the following command.

```bash
php artisan vendor:publish
```
Then type the following text inside your terminal

```bash
->sluggish
```

## Usages

## Controller

### Slug
```python
use LaravelPulse\Sluggish\Sluggish;

// create slug
return Sluggish::generate("slug", "Hello world", Post::class, 'slug');

// update slug
return Sluggish::generate("slug", "maxime-est-aut-sit-est-optio-est", Post::class, 'slug', 1);
return Sluggish::generate("slug", "quia-id-nam-earum-et-doloremque", Post::class, 'slug');
```

### UUID

```python
use LaravelPulse\Sluggish\Sluggish;

// uuid
return Sluggish::generate('uuid', "order", Post::class, 'uuid');
return Sluggish::generate('uuid', "time", Post::class, 'uuid');
return Sluggish::generate('uuid', "hexad", Post::class, 'uuid');
return Sluggish::generate('uuid', "akramul-", Post::class, 'uuid');
return Sluggish::generate('uuid', "datetime", Post::class, 'uuid');
return Sluggish::generate('uuid', "random", Post::class, 'uuid');
return Sluggish::generate('uuid', "random-4 to random-12", Post::class, 'uuid');
return Sluggish::generate('uuid', "hash", Post::class, 'uuid');
return Sluggish::generate('uuid', 1, Post::class, 'uuid');
return Sluggish::generate('uuid', 1, Post::class, 'uuid', 2);
```

### Numeric series with prefix

```python
use LaravelPulse\Sluggish\Sluggish;

// Series Code
return Sluggish::generate('sequence', "SH-", Post::class, 'order_id', 4); // SH-0000
return Sluggish::generate('sequence', "SH-", Post::class, 'order_id', 4);
```
### Use config

```python
// use configuration
return config('sluggish.separator');
```

## Error
without any parameter you can get an exception

```bash
// without anything
return Sluggish::generateSlug("hello world");
```
## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
