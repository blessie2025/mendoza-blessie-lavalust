<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('UserModel');
        $this->call->model('ProductModel');
    }

    public function login()
    {
        $input = $this->api->body();
        $email = trim((string) ($input['email'] ?? ''));
        $password = (string) ($input['password'] ?? '');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
            $this->api->respond_error('Enter a valid email and password.', 422);
        }

        $user = $this->UserModel->find_by_email($email);
        $passwordMatches = $user && (
            $user['password'] === $password ||
            password_verify($password, $user['password'])
        );

        if (!$passwordMatches) {
            $this->api->respond_error('Invalid email or password.', 401);
        }

        $this->session->regenerate_on_login();
        $this->session->set_userdata([
            'user_id' => $user['id'],
            'user_email' => $user['email'],
            'user_role' => $user['role'],
        ]);

        $this->api->respond(['data' => $this->public_user($user)]);
    }

    public function me()
    {
        $this->api->respond(['data' => [
            'id' => $this->session->userdata('user_id'),
            'email' => $this->session->userdata('user_email'),
            'role' => $this->session->userdata('user_role'),
        ]]);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->api->respond(['message' => 'Signed out.']);
    }

    public function index()
    {
        $this->api->respond(['data' => $this->ProductModel->read()]);
    }

    public function create()
    {
        $product = $this->validated_product($this->api->body());
        if (isset($product['error'])) {
            $this->api->respond_error($product['error'], 422);
        }

        $this->ProductModel->create(
            $product['product_name'],
            $product['description'],
            $product['price'],
            $product['quantity']
        );

        $this->api->respond(['message' => 'Product created.'], 201);
    }

    public function update($id)
    {
        $productId = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $existing = $productId ? $this->ProductModel->find($productId) : null;

        if (!$existing) {
            $this->api->respond_error('Product not found.', 404);
        }

        $input = array_merge($existing, $this->api->body());
        $product = $this->validated_product($input);
        if (isset($product['error'])) {
            $this->api->respond_error($product['error'], 422);
        }

        $this->ProductModel->update(
            $productId,
            $product['product_name'],
            $product['description'],
            $product['price'],
            $product['quantity']
        );

        $this->api->respond(['message' => 'Product updated.']);
    }

    public function delete($id)
    {
        $productId = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if (!$productId || !$this->ProductModel->find($productId)) {
            $this->api->respond_error('Product not found.', 404);
        }

        $this->ProductModel->delete($productId);
        $this->api->respond(['message' => 'Product deleted.']);
    }

    private function validated_product(array $input)
    {
        $name = html_entity_decode(trim((string) ($input['product_name'] ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $description = html_entity_decode(trim((string) ($input['description'] ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $price = $input['price'] ?? null;
        $quantity = filter_var($input['quantity'] ?? null, FILTER_VALIDATE_INT);

        if ($name === '' || mb_strlen($name) > 100) {
            return ['error' => 'Product name is required and must be at most 100 characters.'];
        }
        if (mb_strlen($description) > 60000) {
            return ['error' => 'Description is too long.'];
        }
        if (!is_numeric($price) || !is_finite((float) $price) || (float) $price < 0) {
            return ['error' => 'Price must be a number greater than or equal to zero.'];
        }
        if ($quantity === false || $quantity < 0) {
            return ['error' => 'Quantity must be a whole number greater than or equal to zero.'];
        }

        return [
            'product_name' => $name,
            'description' => $description,
            'price' => number_format((float) $price, 2, '.', ''),
            'quantity' => $quantity,
        ];
    }

    private function public_user(array $user)
    {
        return [
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];
    }
}