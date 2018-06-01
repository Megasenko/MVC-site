<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/adminPanel">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Add new</li>
        </ol>
        <div class="row">
            <div class="col-12">
<!--                --><?php //if ($this->getErrorMessage()): ?>
<!--                    <div style="margin-top: 30px" class="text-danger">-->
<!--                        --><?php //echo $this->getErrorMessage(); ?>
<!--                    </div>-->
<!--                --><?php //endif; ?>

                <form method="post" action="addUser">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label class="container">
                                    User name*:
                                    <br>
                                    <input size="50px" type="text" name="name" value="<?= $_POST['name'] ?? '' ?>"
                                           class="form-control"
                                           autofocus required>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="container">
                                    Last name:
                                    <br>
                                    <input size="50px" type="text" name="last_name"
                                           value="<?= $_POST['last_name'] ?? '' ?>" class="form-control">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label class="container">
                                    Login*:
                                    <br>
                                    <input size="50px" type="text" name="login" value="<?= $_POST['login'] ?? '' ?>"
                                           class="form-control"
                                           autofocus required>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="container">
                                    Email*:
                                    <br>
                                    <input size="50px" type="email" name="email"
                                           value="<?= $_POST['email'] ?? '' ?>" class="form-control"
                                           autofocus required>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label class="container">
                                    Password*:
                                    <br>
                                    <input size="50px" type="password" name="password" class="form-control"
                                           autofocus required>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="container">
                                    Password Confirm*:
                                    <br>
                                    <input size="50px" type="password" name="passwordConfirm" class="form-control"
                                           autofocus required>
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button style="margin: 15px" type="submit" name="add" class="btn btn-success">Добавить
                        пользователя
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid-->