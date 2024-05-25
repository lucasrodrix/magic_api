CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE editions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_pt VARCHAR(255) NOT NULL,
    name_en VARCHAR(255) NOT NULL,
    release_date DATE NOT NULL,
    card_count INT NOT NULL
);

CREATE TABLE cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_pt VARCHAR(255) NOT NULL,
    name_en VARCHAR(255) NOT NULL,
    color VARCHAR(50),
    type VARCHAR(50),
    artist VARCHAR(100),
    rarity VARCHAR(50),
    image_url VARCHAR(255),
    description TEXT,
    price DECIMAL(10, 2),
    stock_quantity INT,
    edition_id INT,
    FOREIGN KEY (edition_id) REFERENCES editions(id)
);