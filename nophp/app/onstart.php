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
  pageid INTEGER NOT NULL,
  visibility TEXT DEFAULT 'private'
);
`;
$restaurant_sql = `
CREATE TABLE IF NOT EXISTS restaurant (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  price REAL NOT NULL,
  discount REAL DEFAULT 12.00,
  starsAmount INTEGER NOT NULL,
  address TEXT NOT NULL,
  header TEXT NOT NULL,
  description TEXT NOT NULL,
  pageid INTEGER NOT NULL UNIQUE,
  amountOfSeats INTEGER NOT NULL, 
  isProvidingRecipe INTEGER NOT NULL, /* SQLite doesn't support boolean so we have to use integer instead */
  FOREIGN KEY (pageid) REFERENCES pages(pageid)
);
`;
$session_sql = `
CREATE TABLE IF NOT EXISTS session (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  restaurantID INTEGER NOT NULL,
  timeStart TEXT NOT NULL, /*could be DATE*/
  timeEnd TEXT NOT NULL,
  takenSeats INTEGER NOT NULL DEFAULT 0,
  /*pageid INTEGER NOT NULL, probably isn't required*/
  FOREIGN KEY (restaurantID) REFERENCES restaurant(id)
);
`;
/* when restaurant is created, we have to also add */
$cuisine_sql = `
CREATE TABLE IF NOT EXISTS cuisines (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  restaurantID INTEGER NOT NULL,
  cuisine TEXT NOT NULL,
  FOREIGN KEY (restaurantID) REFERENCES restaurant(id)
);
`;
$restaurant_pictures_sql = `
CREATE TABLE IF NOT EXISTS restaurantPictures (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  restaurantID INTEGER NOT NULL,
  imageid TEXT NOT NULL,
  FOREIGN KEY (restaurantID) REFERENCES restaurant(id)
);
`;
$conn = sql_connect("db.sql");
sql_query($conn, $sql);
sql_query($conn, $user_sql);
sql_query($conn, $sitemap_sql);
sql_query($conn, $restaurant_sql);
sql_query($conn, $session_sql);
?>