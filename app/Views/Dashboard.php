
    <?= view('Components/Header', ['page_title' => "Dashboard"]) ?>
    <?= view('Components/Navbar') ?>
    <div style="margin-left: 3%;">
    <h1><?= session()->user['name'] ?>, Welcome to Dashboard</h1>
    <a class="btn btn-danger" href="/logout">Logout</a>
    </div>
    <!-- <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Profile Photo</th>
        </tr>
        <tr>
            <td><?= session()->user['name'] ?? '' ?></td>
            <td><?= session()->user['email'] ?? '' ?></td>
            <td>
                <?php if (isset(session()->user['profile_picture']) && !empty(session()->user['profile_picture'])): ?>
                    <?php
                    // echo session()->user['profile_picture'];
                    $profilePictureUrl = base_url(session()->user['profile_picture']);
                    ?>
                    <img src="<?= $profilePictureUrl ?>" alt="Profile Photo" width="100">
                <?php else: ?>
                    No profile photo available
                <?php endif; ?>
            </td>
        </tr>
    </table> -->

    <?= view('Components/Footer') ?>