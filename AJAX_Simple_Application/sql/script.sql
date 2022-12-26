CREATE DATABASE task_app;

CREATE TABLE task_app.task (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(250) NOT NULL,
  PRIMARY KEY (id));

INSERT INTO task (ID, name, description) VALUES (1, "write", "write a book"), 
(2, "read", "read a book");
