<body class="bg-dark">
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <?php if ($data): ?>
                <div class="text-danger">

                    <?php echo $data; ?>
                </div>
            <?php endif; ?>
            <?php $_SESSION['error_message'] = false; ?>



            <form action="" method="post">
                <div class="form-group">
                    <label >Login
                        <input class="form-control" name="login" value="<?= $_POST['login']??''?>" autofocus required type="text"
                               placeholder="Enter login">
                    </label>
                </div>
                <div class="form-group">
                    <label >Password
                        <input class="form-control" name="password" type="password" placeholder="Password">
                    </label>
                </div>

                <button class="btn btn-primary " style="margin-left: 45%" name="log">Login</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="/login/register">Register an Account</a>
            </div>
        </div>
    </div>
</div>

</body>