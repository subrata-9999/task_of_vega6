<?= view('Components/Header', ['page_title' => "Login"]) ?>
<?= view('Components/Header', ['page_title' => "Login"]) ?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Login</h3>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <form action="/login" method="post" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control <?= session()->getFlashdata('error') ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Email" required value="<?= old('email') ?>">
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control <?= session()->getFlashdata('error') ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Password" required>
                            <div class="invalid-feedback">
                                Please enter your password.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">Don't have an account? <a href="/register">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('Components/Footer') ?>


<?= view('Components/Footer') ?>