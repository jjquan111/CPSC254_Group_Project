-- Create the database
CREATE DATABASE IF NOT EXISTS calendar;
USE calendar;

-- Create the events table
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    start_event DATETIME NOT NULL,
    end_event DATETIME NOT NULL,

);