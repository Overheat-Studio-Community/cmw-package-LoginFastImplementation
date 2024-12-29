CREATE TABLE IF NOT EXISTS `lf_user`
(
    id         INT(11) PRIMARY KEY AUTO_INCREMENT,
    email      VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY email (email)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;