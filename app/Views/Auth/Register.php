<?= view('Components/Header', ['page_title' => "Registration"]) ?>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Register</h3>
                        <form action="/register" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                <div class="invalid-feedback">
                                    Please enter your name.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <div class="invalid-feedback">
                                    Please enter a password.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture" required>
                                <div class="invalid-feedback">
                                    Please upload a profile picture.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        Already have an account? <a href="/login">Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?= view('Components/Footer'); ?>