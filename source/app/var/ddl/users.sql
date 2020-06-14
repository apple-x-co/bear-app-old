DROP TABLE IF EXISTS `users`;

CREATE TABLE users
(
    id         INTEGER UNSIGNED AUTO_INCREMENT NOT NULL,
    username   VARCHAR(50)                     NOT NULL COMMENT '氏名',
    email      VARCHAR(100)                    NOT NULL COMMENT 'メールアドレス',
    created_at DATETIME                        NOT NULL,
    updated_at DATETIME                        NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT = 'ユーザー';