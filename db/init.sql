CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    genre VARCHAR(100),
    year INT
);

INSERT INTO books (title, author, genre, year)
VALUES
('The Hobbit', 'J.R.R. Tolkien', 'Fantasy', 1937),
('1984', 'George Orwell', 'Dystopian', 1949);
