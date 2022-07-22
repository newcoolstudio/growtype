<?php

return [
    'clear_transient_cache_on_load' => !empty(env('CLEAR_TRANSIENT_CACHE_ON_LOAD')) ? env('CLEAR_TRANSIENT_CACHE_ON_LOAD') : false,
    'default_expiration_time' => 24 * 60 * 60 * 30,
];
