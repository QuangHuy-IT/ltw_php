<?php
require_once __DIR__.'/../../inc/auth.php'; requireLogin();
echo json_encode($pdo->query('SELECT * FROM owners ORDER BY owner_id DESC')->fetchAll());
