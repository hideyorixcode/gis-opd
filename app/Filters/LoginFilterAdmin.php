<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilterAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session('status') != 'ADMIN') {
            return redirect()->to(base_url('dashboard'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null )
    {
        // Do something here
    }
}