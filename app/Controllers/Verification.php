<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Verification extends Controller
{
    public function approve($username)
    {
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            return "User tidak ditemukan.";
        }

        $userModel->where('username', $username)->set(['status' => 'approved'])->update();
        $user['status'] = 'approved';

        return view('auth/approved_register', ['user' => $user]);
    }

    public function reject($username)
    {
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            return "User tidak ditemukan.";
        }

        $userModel->where('username', $username)->set(['status' => 'rejected'])->update();
        $user['status'] = 'rejected';

        return view('auth/rejected_register', ['user' => $user]);
    }
}
