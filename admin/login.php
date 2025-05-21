<?php
session_start();
require_once __DIR__.'/../config/db.php';

if (isset($_SESSION['admin_id'])) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    $stmt = $pdo->prepare('SELECT user_id, full_name, password FROM users
                           WHERE username = ? AND role = "admin" LIMIT 1');
    $stmt->execute([$user]);
    $row = $stmt->fetch();

    if ($row && hash_equals($row['password'], hash('sha256', $pass))) { // demo
        $_SESSION['admin_id']   = $row['user_id'];
        $_SESSION['admin_name'] = $row['full_name'];
        header('Location: dashboard.php'); exit;
    } else $error = 'Sai tài khoản hoặc mật khẩu';
}
?>
<!doctype html><html lang="vi"><head>
<meta charset="utf-8"><title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="bg-light d-flex align-items-center" style="height:100vh">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h3 class="text-center mb-4">Đăng nhập Admin</h3>
      <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
      <form method="post" class="card card-body">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input name="username" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>
</div>
</body></html>
