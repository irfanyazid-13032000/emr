<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Noauth implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (session('username')) {
      return redirect()->to('/dashboard/welcome');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)

  {
  }
}
