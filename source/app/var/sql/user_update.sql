UPDATE users
   SET username = :username,
       email = :email,
       updated_at = :updated_at
 WHERE id = :id;
