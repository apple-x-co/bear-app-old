INSERT INTO users (username, email, created_at, updated_at)
VALUES (:username, :email, now(), now());