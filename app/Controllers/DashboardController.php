<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!session()->get('user')) {
            return redirect()->to('/login');
        }
        return view('Dashboard');
    }

    public function profile()
    {
        if (!session()->get('user')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user')['id'];
        $user = $this->userModel->find($userId);

        if (!$user) {
            // Handle user not found scenario
            return redirect()->to('/login')->with('error', 'User not found.');
        }

        $data = [
            'user' => $user,
        ];

        return view('Profile', $data);
    }
    public function go_to_search()
    {
        if (!session()->get('user')) {
            return redirect()->to('/login');
        }
        return view('SearchPage');
    }



    

}
