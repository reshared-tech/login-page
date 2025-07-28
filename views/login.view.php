<?php require('partials/head.view.php') ?> 

<div class="card">
    <div class="header">
        <h1 class="title">Welcome back</h1>
        <p class="subtitle">Please login your account</p>
    </div>
    
    <form class="form" method="POST">
        <div class="form-group">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" id="email" class="form-input" placeholder="email" value="<?= oldData('email') ?>">
            <p class="form-hint"><?= error('email') ?></p>
        </div>
        
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-input" placeholder="Password" required>
            <p class="form-hint"><?= error('password') ?></p>
            <!-- <div class="flex justify-between items-center mt-1">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="form-checkbox">
                    <label for="remember" class="form-checkbox-label">Remember me</label>
                </div>
                <a href="#" class="link">Forgot Password?</a>
            </div> -->
        </div>
        
        <button type="submit" class="btn-primary">Sign in</button>
        
        <div class="footer">
            <p class="text-sm">Don't have an account? <a href="/index.php/register" class="link">Sign up</a></p>
        </div>
    </form>
</div>

<?php require('partials/foot.view.php') ?> 