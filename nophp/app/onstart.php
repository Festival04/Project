<?php
// 02.2024 Artur Z (HUSKI3@GitHub)
// Executed when nophp server is started
$sql = `
CREATE TABLE IF NOT EXISTS pages (
  pageid INTEGER PRIMARY KEY AUTOINCREMENT,
  author INTEGER,
  title TEXT,
  content TEXT,
  visibility TEXT DEFAULT 'private',
  created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (author) REFERENCES user(id)
);
`;
$user_sql = `
CREATE TABLE IF NOT EXISTS user (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT NOT NULL UNIQUE,
  name TEXT NOT NULL,
  email TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  role TEXT,
  /*profilePicture BLOB,*/
  registrationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
`;
$sitemap_sql = `
CREATE TABLE IF NOT EXISTS sitemap (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  route TEXT NOT NULL UNIQUE,
  pageid INT NOT NULL,
  visibility TEXT DEFAULT 'private'
);
`;
$restaurant_sql = `
CREATE TABLE IF NOT EXISTS restaurant (
  restaurantID INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  price REAL NOT NULL,
  cuisine TEXT NOT NULL /*array*/,
  starsAmount INT NOT NULL,
  description TEXT NOT NULL,
  pageid INT NOT NULL UNIQUE,
  /*amountOfSeats INT NOT NULL, */
  FOREIGN KEY (pageid) REFERENCES pages(pageid)
);
`;
$session_sql = `
CREATE TABLE IF NOT EXISTS session (
  session ID INTEGER PRIMARY KEY AUTOINCREMENT,
  timeStart TEXT NOT NULL,
  timeEnd TEXT NOT NULL,
  pageID INT NOT NULL,
  visibility TEXT DEFAULT 'private'
);
`;
$conn = sql_connect("db.sql");
sql_query($conn, $sql);
sql_query($conn, $user_sql);
sql_query($conn, $sitemap_sql);
?>