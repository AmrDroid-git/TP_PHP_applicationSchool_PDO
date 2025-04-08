-- executer ce code dans MySQL shell pour créer la base de données et la table 
CREATE DATABASE IF NOT EXISTS PHP_TP;
USE PHP_TP;

CREATE TABLE IF NOT EXISTS STUDENT(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    birthday DATE NOT NULL
);


INSERT INTO student (name, birthday) VALUES
('Aymen', '1982-02-07'),
('Messi','1990-02-02'),
('Ronaldo','1988-11-03'),
('Maradona','1900-05-09'),
('Skander', '2018-07-11');


-- ajout des details pour les etudiants
ALTER TABLE student ADD COLUMN section VARCHAR(50);
UPDATE student SET section = 'gl' WHERE id = 1;
UPDATE student SET section = 'rt' WHERE id = 2;
UPDATE student SET section = 'gl' WHERE id = 3;
UPDATE student SET section = 'imi' WHERE id = 4;
UPDATE student SET section = 'gl' WHERE id = 5;

-- ALTER TABLE student ADD COLUMN moyenne FLOAT;
-- UPDATE student SET moyenne = 12.59 WHERE id = 1;
-- UPDATE student SET moyenne = 3 WHERE id = 2;
-- UPDATE student SET moyenne = 2 WHERE id = 3;
-- UPDATE student SET moyenne = 15.80 WHERE id = 4;
-- UPDATE student SET moyenne = 18.45 WHERE id = 5;


--ajout photo pour chaque etudiant
ALTER TABLE student ADD COLUMN photo VARCHAR(500);
UPDATE student SET photo = 'https://img.freepik.com/free-photo/matrix-hacker-background_23-2150082005.jpg?semt=ais_hybrid&w=740' WHERE id = 1;
UPDATE student SET photo = 'https://static.vecteezy.com/system/resources/thumbnails/006/198/869/small/internet-security-protection-from-hacker-attacking-cyber-attack-and-network-security-concept-free-photo.jpg' WHERE id = 2;
UPDATE student SET photo = 'https://images.pexels.com/photos/38275/anonymous-studio-figure-photography-facial-mask-38275.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500' WHERE id = 3;
UPDATE student SET photo = 'https://cdn.pixabay.com/photo/2016/11/19/22/52/coding-1841550_1280.jpg' WHERE id = 4;
UPDATE student SET photo = 'https://scx2.b-cdn.net/gfx/news/hires/2018/hack.jpg' WHERE id = 5;





--table section
CREATE TABLE section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(50) NOT NULL,
    description TEXT NOT NULL
);
INSERT INTO section (designation, description) VALUES
('gl', 'Cette section forme des ingénieurs en développement de logiciels, couvrant des domaines tels que la science des données, le DevOps et le développement dapplications.'),
('rt', 'Axée sur les réseaux et les télécommunications, cette section prépare les étudiants à des carrières dans la sécurité des réseaux, les systèmes embarqués et les communications.'),
('iia', 'Cette filière vise à former des ingénieurs maîtrisant les outils de production automatisée, incluant des techniques informatiques avancées telles que les systèmes temps réel, le contrôle, la commande et la robotique.'),
('imi', 'Cette section est dédiée à la formation en maintenance des systèmes industriels et en instrumentation.');
