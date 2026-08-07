<?php

class AuthController extends Controller {
    public function login() {
        $this->view('auth/login', [
            'pageTitle' => 'Sign In - Richmondtech'
        ]);
    }

    public function register() {
        $this->view('auth/register', [
            'pageTitle' => 'Create Account - Richmondtech'
        ]);
    }
}
