UPDATE users
   SET username = :username,
       email = :email,
       updated_at = now()
 WHERE id = :id;