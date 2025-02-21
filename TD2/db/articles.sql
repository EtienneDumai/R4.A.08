CREATE DATABASE IF NOT EXISTS articles;
USE articles;
CREATE TABLE article (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    auteur VARCHAR(100) NOT NULL,
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO article (titre, contenu, auteur) VALUES
('Introduction à MariaDB', 'MariaDB est un fork de MySQL qui offre plus de performance et de flexibilité.', 'Alice Dupont'),
('Les bases de SQL', 'SQL permet dinteragir avec une base de données pour insérer, supprimer et récupérer des données.', 'Jean Martin'),
('Optimisation des requêtes SQL', 'Loptimisation des requêtes SQL est essentielle pour améliorer les performances.', 'Sophie Bernard'),
('Les jointures en SQL', 'Les jointures permettent de combiner plusieurs tables pour obtenir des données précises.', 'Pierre Durand'),
('Sécurité des bases de données', 'Il est crucial de sécuriser les bases de données pour éviter les failles de sécurité.', 'Emma Leroy');
