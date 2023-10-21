# WebProgLabUTS-Final
UTS Projek Todo List Web Programming Oktober 2023

#Database : utswebproglab <br/>

#Table ms_user: <br/>
CREATE TABLE ms_user (id INT NOT NULL AUTO_INCREMENT , name VARCHAR(150) NOT NULL , username VARCHAR(100) NOT NULL , password VARCHAR(150) NOT NULL , create_date DATETIME NOT NULL , PRIMARY KEY (id), UNIQUE (username)) ENGINE = InnoDB COMMENT = 'data user LAB';

#TABEL todolist:<br/>
CREATE TABLE todolist (id INT NOT NULL , task_id INT NOT NULL AUTO_INCREMENT , task VARCHAR(150) NOT NULL , done BOOLEAN NOT NULL , progress VARCHAR(100) NOT NULL , tanggal DATE NOT NULL , create_date DATETIME NOT NULL , deskripsi TEXT NOT NULL , PRIMARY KEY (task_id), FOREIGN KEY (id) REFERENCES ms_user(id) ) ENGINE = InnoDB COMMENT = 'tabel todolist LAB';
