INSERT INTO users (username, email, password, created_at, updated_at)
VALUES (:username, :email, :password, now(), now());