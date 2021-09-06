    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" action="<?= base_url('auth'); ?>">
                                        <?php echo $this->session->flashdata('message');
                                        unset($_SESSION['message']) ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email" name='email' placeholder="Enter Email Address..." value="<?= set_value('email') ?>">
                                            <?= form_error('email', "<small class='pl-2 text-danger'>", "</small>") ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="password" value="<?= set_value('password') ?>" placeholder="Password">
                                            <?= form_error('password', "<small class='pl-2 text-danger'>", "</small>") ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('Auth/register')  ?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>