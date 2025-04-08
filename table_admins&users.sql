USE PHP_TP;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL
);


INSERT INTO users (username, email, role) VALUES
('Amr', 'amrdroidcommunity@gmail.com', 'admin'),
('Karim', 'karim@gmail.com', 'user'),
('Ferdawes', 'ferdawes@gnail.com', 'user'),
('Nadhir', 'nadhir@gmail.com', 'admin'),
('Bilel', 'bilel@gmail.com', 'user');



