<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 * 
 * Automatically generated via CLI.
 */
class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function showUsers()
    {
      $data['users'] = [];

      $hasDatabaseConfig = !empty(getenv('DB_HOST')) && !empty(getenv('DB_NAME'));

      if ($hasDatabaseConfig) {
          try {
              $this->call->database();
              $this->call->model('UserModel');
              $data['users'] = $this->UserModel->all();
          } catch (Exception $e) {
              $data['users'] = [];
          }
      }

      $this->call->view('users', $data);
    }
}