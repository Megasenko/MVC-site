<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/adminPanel">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Users</li>
        </ol>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/adminPanel/addUser">Add new</a>
            </li>
        </ol>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Users list
                <span style="margin-left: 30px">Number of users : <?= count($data) - 1 ?> </span>
                <span style="margin-left: 30px">Role : 1 - admin , 2 - moderator , 3 - user</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Login</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Login</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $users = $data; ?>
                        <?php if ($users): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user->id ?></td>
                                    <td><?= $user->name ?></td>
                                    <td><?= $user->last_name ?></td>
                                    <td><?= $user->login ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->role ?></td>
                                    <td>
                                        <a href="/adminPanel/editUser?<?= $user->id; ?>">Edit</a><br>
                                        <a href="/adminPanel/delUser?<?= $user->id; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Users not found!</p>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- /.container-fluid-->