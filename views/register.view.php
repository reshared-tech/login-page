<?php require('partials/head.view.php') ?> 

<div class="card">
    <div class="header">
        <h1 class="title">Welcome</h1>
        <p class="subtitle">Register a new account</p>
    </div>
    
    <form class="form" method="POST">
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-input" placeholder="Name" required value="<?= oldData('name') ?>">
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email address</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="example@example.com" value="<?= oldData('email') ?>">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Confirm-password</label>
            <input type="password" id="password" name="password" class="form-input" placeholder="Password" required>
        </div>

        <div class="form-group">
            <label for="confirm-password" class="form-label">Confirm-password</label>
            <input type="password" id="confirm-password" name="confirm_password" class="form-input" placeholder="Confirm-password" required>
        </div>
        
        <button type="submit" class="btn-primary">Sign in</button>
        
        <div class="footer">
            <p class="text-sm">Already have an account? <a href="/index.php/login" class="link">Log in</a></p>
        </div>
    </form>
</div>

<?php require('partials/foot.view.php') ?> 