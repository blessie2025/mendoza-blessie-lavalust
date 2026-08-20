<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    public function index()
    {
        $this->call->view('errors/student_home');
    }

    public function profile()
    {
        $student = [
            'student_id' => '2026-0001',
            'name'       => 'Juan Dela Cruz',
            'course'     => 'BS Information Technology',
            'year_level' => '2nd Year',
            'section'    => 'A',
            'email'      => 'juan@example.com'
        ];

        $this->call->view('errors/student_profile', $student);
    }
}