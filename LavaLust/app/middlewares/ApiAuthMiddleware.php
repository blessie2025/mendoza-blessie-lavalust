<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuthMiddleware
{
    public function handle($next)
    {
        $session = load_class('session', 'libraries');

        if (!$session->has_userdata('user_id')) {
            http_response_code(401);
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode(['error' => 'Authentication required.', 'status' => 401]);
            exit;
        }

        return $next();
    }
}