# Sluggish

Sluggish is a laravel library package for generating unique slug, custom slug, unique id, uuid, sequential number with prefix.

## Requirements

PHP version : 8.0 or higher
Laravel version : 8, 9, 10, 11 (capable with those versions)

## Installation

Use the package run the following command.

```bash
composer require laravel-pulse/sluggish
```

## configuration

publish the sluggish configuration files

```bash
php artisan vendor:publish --provider="LaravelPulse\Sluggish\SluggishServiceProvider"
```

This command will Publish default configuration inside config/sluggish.php

```bash
<?php

return [
    // The separator used to generate slugs. For example, if the separator is '-', a title like "Hello World" will be transformed to "hello-world".
    'separator' =>  '-',

    // If a slug cannot be generated using the configured separator, this fallback separator will be used. For example, if the fallback separator is '_', "Hello World" will be transformed to "hello_world" if the primary separator fails.
    'fallback-separator' =>  '_',

    // The maximum number of attempts to generate a unique slug. If a generated slug already exists, a new attempt will be made up to the specified limit.
    'max-attempts' => 100,

    // The default value to be used if no value is provided.
    'default-value' =>  '4',
];
```

## Usages

## The best thing is you can use Sluggish everywhere as per as your needs.

### For example Controllers, Models, Traits, Commands, jobs, etc.

## What or Which properties Sluggish want

### Sluggish want 4 mandatory parameters in order to generate a unique slug or UUID or Sequence number

#### 1. `string $type` - This parameter should contain what do you want to generate from Sluggish. It could be a string. Sluggish accept only three types one is "slug", "uuid" and "sequence".

#### 2. `string $parameter` - This parameter should contain what or which string or input should convert into a slug / uuid / sequence number. like "Hello world" or $request->title or your custom field.

#### 3. `object $model` - This parameter should contain the Model. Sluggish will execute the query and return the corresponding unique slug / uuid / sequence number. you can use any of your model like User::class, Post::class so on.

#### 4. `string $modelField` - This parameter should contain the corresponding Model field which you want to keep Unique. It could be any of your custom field. You can use any of your custom field like "slug", "username", "unique_id", or "unique_key".

### If you want to update any of your custom fields records just pass the id. Sluggish will also accept the id field.

#### you need to pass in this order otherwise Sluggish can through an error

```bash
//  First Parameter : Model Class Name (String)
//  Second Parameter: Field name from which the slug should be generated (String).
//  Third Parameter : Model::class
//  Fourth Parameter: ModelField name that contains the data for generated the slug.
// Fifth Parameter: ID of any record. it is used for updating any existing record


Sluggish::generate($type, $parameter, $model, $modelField, $id = optional);
```

### Generate Slug

```bash
use LaravelPulse\Sluggish\Sluggish;

// create slug
public function store(Request $request)
{
    $post = Post::create([
        'title' => $request->title,
        'slug' => Sluggish::generate('slug', $request->title, Post::class, 'slug') // hello-world , hello-world-1, hello-world-2 .....
    ]);

    return redirect()->route('posts.index');
}

// update slug
public function update(Request $request,Post $post)
{
    $post->update([
        'title' => $request->title,
        'slug' => Sluggish::generate("slug", $request->title, Post::class, 'slug', $post)
        // if it get same id and same title  return existing slug
        // otherwise
        // hello-world , hello-world-1, hello-world-2 .....
    ]);

    return redirect()->route('posts.index');
}
```

### Generate UUID

```python
use LaravelPulse\Sluggish\Sluggish;

// create uuid
public function store(Request $request)
{
    return Sluggish::generate('uuid', 2, Post::class, 'unique_id');

    $post = Post::create([
        'title' => $request->title,
        'unique_id' => Sluggish::generate('uuid', "order", Post::class, 'unique_id'), // 9b75b69a-a146-40c3-a4dc-4701204fbfd9
    ]);

    return redirect()->route('posts.index');
}

Example 1)  9b75b69a-a146-40c3-a4dc-4701204fbfd9
return Sluggish::generate('uuid', "order", Post::class, 'uuid');

Example 2)  65e1d5936027d
return Sluggish::generate('uuid', "time", Post::class, 'uuid');

Example 3)  dc542c3a-992b-4338-8a73-38f027e2a923
return Sluggish::generate('uuid', "hexad", Post::class, 'uuid');

Example 4)  prefix-65e1d5ff5201a7.85005484
return Sluggish::generate('uuid', "prefix-", Post::class, 'uuid');

Example 5)  202403011709299240
return Sluggish::generate('uuid', "datetime", Post::class, 'uuid');

Example 6)  9501709299298
return Sluggish::generate('uuid', "random", Post::class, 'uuid');

Example 7)  8505 (4 digits OTP format)
return Sluggish::generate('uuid', "random-4", Post::class, 'uuid');


### you can also define your own length
return Sluggish::generate('uuid', "random-5", Post::class, 'uuid'); // 84047 (5 digits OTP format)

return Sluggish::generate('uuid', "random-6", Post::class, 'uuid'); // 640470 (6 digits OTP format)

return Sluggish::generate('uuid', "random-7", Post::class, 'uuid'); // 2404706

return Sluggish::generate('uuid', "random-8", Post::class, 'uuid'); // 77346768

return Sluggish::generate('uuid', "random-9", Post::class, 'uuid'); // 362184146

return Sluggish::generate('uuid', "random-10", Post::class, 'uuid'); // 2363990894

return Sluggish::generate('uuid', "random-11", Post::class, 'uuid'); // 16497741413

return Sluggish::generate('uuid', "random-12", Post::class, 'uuid'); // 546406371883

Example 8)  $2y$12$XZojOl5wvjUAG.YVDCwyVu/sELFbhpQsWprZblt/HaofTzfnQPiam
return Sluggish::generate('uuid', "hash", Post::class, 'uuid');

### you can also pass an integer like this (1 to 255)
Example 9) 5416101709302967
return Sluggish::generate('uuid', 2, Post::class, 'uuid');
```

### Generate Numeric series with prefix

```python
use LaravelPulse\Sluggish\Sluggish;

public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,

            // you can change the prefix as per your need like "ORD"
            // if no post record found inside database -> SH-0000
            // if post record found inside database -> SH-1000
            // if you define 1 to n value for last key -> [for 1 - SH-0 , for 2 - SH-00, for 3 - SH-000 , for 4 - SH-0000,  by default the value is 4 for this reason you get SH-0000]

            'serial_key' => Sluggish::generate('sequence', "SH-", Post::class, 'serial_key', 4),

            // you can also try like this
            'serial_key' => Sluggish::generate('sequence', "SH-", Post::class, 'order_id'); // SH-0000

            // remember if you insert any data using one of those methods you should migrate::fresh to try another otherwise both of those not working properly.
        ]);

        return redirect()->route('posts.index');
    }

```

## Error

without any parameter you can get an exception

```bash
// if any parameter is not specified
// if given parameter is unordered
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
