<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        // Check if user is admin
        if (session()->get('is_admin') != 1) {
            return redirect()->to('/dashboard')->with('error', 'Access denied. Admins only.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing here
    }
}
