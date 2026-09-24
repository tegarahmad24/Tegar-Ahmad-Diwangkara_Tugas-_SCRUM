<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Biodata</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: linear-gradient(180deg, #10131c 0%, #1c2233 100%); color: #fff; }
        .page { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .card { width: 100%; max-width: 420px; padding: 32px 28px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.14); border-radius: 14px; }
        h1 { text-align: center; margin-bottom: 24px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input { width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid #454d5f; background: #292f40; color: #fff; }
        input:focus { outline: none; border-color: #00c2ff; }
        .btn { width: 100%; padding: 12px; background: linear-gradient(90deg, #00c2ff, #a86bff); color: #fff; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; }
        .btn:hover { opacity: 0.9; }
        .error { color: #ffbcc4; margin-top: 8px; font-size: 13px; }
        .flash { margin-bottom: 18px; padding: 10px 12px; border-radius: 8px; background: rgba(220,53,69,0.18); border: 1px solid rgba(220,53,69,0.6); color: #ffdfe3; }
        .hint { text-align: center; margin-top: 16px; color: #b8bdc9; font-size: 13px; }
    </style>
</head>
<body>
    <div class="page">
        <div class="card">
            <h1>Login Biodata</h1>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="flash"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>

            <form action="<?= site_url('login') ?>" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?= old('username') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('username')) : ?>
                        <div class="error"><?= esc($validation->getError('username')) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <?php if (isset($validation) && $validation->hasError('password')) : ?>
                        <div class="error"><?= esc($validation->getError('password')) ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn">Login</button>
            </form>

            <div class="hint">Demo user: admin / admin123</div>
        </div>
    </div>
</body>
</html>
