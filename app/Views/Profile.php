<?= view('Components/Header', ['page_title' => "Profile"]) ?>
<?= view('Components/Navbar') ?>
<div style="margin-left: 3%;">
    <h1><?= session()->user['name'] ?>, Welcome to Profile</h1>
</div>


<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">User Profile</h2>
        </div>
        <div class="card-body">
            <form id="editProfileForm" action="profile/update" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" readonly>
                    </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                    </div>
                <div class="mb-3">
                    <label for="profilePicture" class="form-label">Profile Picture</label>
                    <div>
                        <img src="<?= base_url($user['profile_picture']) ?>" alt="Profile Photo" id="profilePicture" class="card-img-top rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                        <input type="file" id="profile_picture" name="profile_picture" class="form-control" style="display: none;">

                    </div>
                </div>
                <button type="button" id="editButton" class="btn btn-primary mt-2">Edit</button>
                <button type="submit" id="saveButton" class="btn btn-success mt-2" style="display: none;">Save</button>
                <button type="button" id="cancelButton" class="btn btn-secondary mt-2 ml-2" style="display: none;">Cancel</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-2Ie4Vx/8ISQwk9CJQAghy9OsLP1BdGVh1S2fIWtYXTp5bN7J9x90cz5Ks/uStoRv" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
   document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.getElementById('editButton');
    const saveButton = document.getElementById('saveButton');
    const cancelButton = document.getElementById('cancelButton');
    const profile_picture_button = document.getElementById('profile_picture');
    const inputs = document.querySelectorAll('#editProfileForm input:not([type="file"])');

    editButton.addEventListener('click', function() {
        // Enable editing
        inputs.forEach(input => {
            input.removeAttribute('readonly');
        });
        saveButton.style.display = 'inline-block';
        cancelButton.style.display = 'inline-block';
        profile_picture_button.style.display = 'inline-block';
        editButton.style.display = 'none';
    });

    cancelButton.addEventListener('click', function() {
        // Cancel editing
        inputs.forEach(input => {
            input.setAttribute('readonly', true);
        });
        saveButton.style.display = 'none';
        cancelButton.style.display = 'none';
        editButton.style.display = 'inline-block';
        profile_picture_button.style.display = 'none';
        window.location.reload();
    });

   

});
</script>


<?= view('Components/Footer') ?>