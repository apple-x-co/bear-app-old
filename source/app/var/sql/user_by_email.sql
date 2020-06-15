SELECT id, username, email, created_at, updated_at
  FROM users
 WHERE email = :email;