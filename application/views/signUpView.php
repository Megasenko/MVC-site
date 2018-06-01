<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <div class="card-body">
            <?php if ($data): ?>
                <div class="text-danger">

                    <?php echo $data; ?>
                </div>
            <?php endif; ?>
            <?php $_SESSION['error_message'] = false; ?>

            <form method="post" action="register">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputName">Name</label>
                            <input class="form-control" id="exampleInputName" name="name" value="<?= $_POST['name']??''?>" autofocus required type="text" aria-describedby="nameHelp"
                                   placeholder="Enter first name">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputLastName">Last name</label>
                            <input class="form-control" id="exampleInputLastName" name="last_name" value="<?= $_POST['last_name']??''?>" type="text"
                                   aria-describedby="nameHelp" placeholder="Enter last name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputLogin1">Email login</label>
                            <input class="form-control" id="exampleInputLogin1" name="login" value="<?= $_POST['login']??''?>" required type="text" aria-describedby="loginHelp"
                                   placeholder="Enter login">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Email address</label>
                            <input class="form-control" id="exampleInputEmail1" name="email" value="<?= $_POST['email']??''?>" required type="email"
                                   aria-describedby="emailHelp"
                                   placeholder="Enter email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">Password</label>
                            <input class="form-control" id="exampleInputPassword1" name="password" required type="password"
                                   placeholder="Password">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleConfirmPassword">Confirm password</label>
                            <input class="form-control" id="exampleConfirmPassword" name="passwordConfirm" required type="password"
                                   placeholder="Confirm password">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" name="register" >Register</button>
            </form>

        </div>
    </div>
</div>