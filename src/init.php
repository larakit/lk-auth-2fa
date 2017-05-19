<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit
 * User: Alexey Berdnikov
 * Date: 18.05.17
 * Time: 16:17
 */
\Larakit\Boot::register_middleware_group('2fa', \Larakit\Google2fa\Google2faMiddleware::class);
\Larakit\Boot::register_boot(__DIR__.'/boot');