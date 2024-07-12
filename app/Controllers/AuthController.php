<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function go_to_register()
    {
        if(session()->get('user')){
            return redirect()->to('/dashboard');
        }
        return view('Auth/register');
    }
    public function register()
    {
        if(session()->get('user')){
            return redirect()->to('/login');
        }
        $validation = $this->validate([
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required',
            'profile_picture' => 'uploaded[profile_picture]|max_size[profile_picture,1024]|is_image[profile_picture]|mime_in[profile_picture,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$validation) {
            return redirect()->to('/register')->withInput()->with('validation', $this->validator);
        }

        $profilePicture = $this->request->getFile('profile_picture');
        $uploadPath = FCPATH . 'uploads/profile_pictures'; // Absolute path to the directory

        // Check if the directory exists, if not create it
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true); // Create the directory with the correct permissions
        }

        if ($profilePicture->isValid() && !$profilePicture->hasMoved()) {
            // Generate a new name for the file to avoid overwriting
            $newName = $profilePicture->getRandomName();

            // Move the file to the writable/uploads/profile_pictures directory
            $profilePicture->move($uploadPath, $newName);

            $profilePicturePath = 'uploads/profile_pictures/' . $newName;
        } else {
            return redirect()->to('/register')->withInput()->with('error', 'There was an error uploading the profile picture.');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'profile_picture' => $profilePicturePath,
        ];

        $this->userModel->insert($data);

        return redirect()->to('/login');
    }

    public function go_to_login()
    {
        if(session()->get('user')){
            return redirect()->to('/dashboard');
        }
        return view('Auth/login');
    }
    public function login()
    {
        if(session()->get('user')){
            return redirect()->to('/dashboard');
        }
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->to('/login')->withInput()->with('error', 'Invalid credentials');
        }


        session()->set('user', $user);
        session()->setFlashdata('success', 'You have successfully logged in');


        return redirect()->to('/dashboard');
    }

    public function update()
{
    // Ensure user is authenticated
    if (!session()->get('user')) {
        return redirect()->to('/login');
    }

    // Validate input data
    $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[users.email,id,' . session()->get('user')['id'] . ']',
    ];

    // Check if profile picture file is uploaded
    $profilePictureFile = $this->request->getFile('profile_picture');
    if ($profilePictureFile) {
        $validationRules['profile_picture'] = 'uploaded[profile_picture]|max_size[profile_picture,1024]|is_image[profile_picture]';
    }

    

    $validation = $this->validate($validationRules);

    if (!$validation) {
        return redirect()->to('/profile')->withInput()->with('validation', $this->validator);
    }

   
    // Update user data in database
    $userId = session()->get('user')['id'];
    $data = [
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
    ];

    // Handle profile picture upload
    if ($profilePictureFile && $profilePictureFile->isValid()) {
        // Generate a unique name for the file
        $newProfilePictureName = $profilePictureFile->getRandomName();

        // Move uploaded file to a writable directory using FCPATH
        $profilePictureFile->move(FCPATH . 'uploads/profile_pictures', $newProfilePictureName);

        // Update profile picture path in $data
        $data['profile_picture'] = 'uploads/profile_pictures/' . $newProfilePictureName;
    }

    try {
        $this->userModel->update($userId, $data);
        return redirect()->to('/profile')->with('success', 'Profile updated successfully.');
    } catch (\Exception $e) {
        // Handle database or other errors
        return redirect()->to('/profile')->with('error', 'Failed to update profile: ' . $e->getMessage());
    }
}


    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('success', 'You have successfully logged out');

        return redirect()->to('/login');
    }
}
