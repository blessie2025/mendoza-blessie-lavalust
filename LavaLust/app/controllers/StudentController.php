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
            'student_id' => 'MCC2024-00149',
            'name'       => 'Blessie C Mendoza',
            'course'     => 'BS Information Technology',
            'year_level' => '3rd Year',
            'section'    => 'F3',
            'email'      => 'blessiemendoza853gmail.com'
        ];

        $this->call->view('errors/student_profile', $student);
    }
}