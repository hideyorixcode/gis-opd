<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilterAdminPetugas implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        if (session('hak_akses') != 'admin') {
            return redirect()->to(base_url('dashboard'));
        } else if (session('hak_akses') != 'petugas') {
            return redirect()->to(base_url('dashboard'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}