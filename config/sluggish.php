<?php

return [
    // The separator used to generate slugs. For example, if the separator is '-', a title like "Hello World" will be transformed to "hello-world".
    'separator' =>  '-',

    // If a slug cannot be generated using the configured separator, this fallback separator will be used. For example, if the fallback separator is '_', "Hello World" will be transformed to "hello_world" if the primary separator fails.
    'fallback-separator' =>  '_',

    // The maximum number of attempts to generate a unique slug. If a generated slug already exists, a new attempt will be made up to the specified limit.
    'max-attempts' => 100,
];
