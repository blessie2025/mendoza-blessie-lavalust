<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class MigrationMiddleware
{
    public function handle($next)
    {
        if (PHP_SAPI === 'cli') {
            return $next();
        }

        if (config_item('environment') === 'production') {
            http_response_code(404);
            exit;
        }

        $session = load_class('session', 'libraries');
        if ($session->userdata('user_role') !== 'admin') {
            show_error('403 Forbidden', 'Administrator access is required for migration operations.', 'error_general', 403);
            exit;
        }

        return $next();
    }
}