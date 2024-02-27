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
  password TEXT NOT NULL
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
$conn = sql_connect("db.sql");
sql_query($conn, $sql);
sql_query($conn, $user_sql);
sql_query($conn, $sitemap_sql);
?>