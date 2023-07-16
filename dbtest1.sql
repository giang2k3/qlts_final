
CREATE TABLE Students (
  student_id INT PRIMARY KEY,
  student_name VARCHAR(50),
  student_email VARCHAR(100),
  student_date_of_birth DATE,
  student_gender ENUM('Male', 'Female'),
  student_address VARCHAR(100),
  student_password VARCHAR(50) NOT NULL,
  message TEXT
);

CREATE TABLE Exams (
  exam_id INT PRIMARY KEY,
  exam_name VARCHAR(50),
  exam_date DATE
);

CREATE TABLE Results (
  result_id INT PRIMARY KEY,
  result_student_id INT,
  result_exam_id INT,
  result_score FLOAT,
  FOREIGN KEY (result_student_id) REFERENCES Students(student_id),
  FOREIGN KEY (result_exam_id) REFERENCES Exams(exam_id)
);

CREATE TABLE feedbacks (
    id INT  AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    content TEXT,
    completed TINYINT(1) NOT NULL DEFAULT 0,
    message TEXT,
    FOREIGN KEY (student_id) REFERENCES Students(student_id)
);



INSERT INTO Exams (exam_id,exam_name,exam_date) VALUES
(1,'Math','2021-7-2'),
(2,'Physics','2021-7-3'),
(3,'Chemistry','2021-7-3'),
(4,'English','2021-7-1'),
(5,'Literature','2021-7-1');

INSERT INTO Students (student_id, student_name, student_email, student_date_of_birth, student_gender, student_address,student_password)
VALUES
(1, 'John Doe', 'john.doe@example.com', '2000-01-01', 'Male', '123 Main Street','john2011'),
(2, 'Jane Smith', 'jane.smith@example.com', '2000-02-02', 'Female', '456 Elm Street','jane2022'),
(3, 'David Johnson', 'david.johnson@example.com', '2000-03-03', 'Male', '789 Oak Street','david2033'),
(4, 'Emily Brown', 'emily.brown@example.com', '2000-04-04', 'Female', '321 Pine Street','emily2044'),
(5, 'Michael Wilson', 'michael.wilson@example.com', '2000-05-05', 'Male', '654 Maple Avenue','michael2055'),
(6, 'Olivia Taylor', 'olivia.taylor@example.com', '2000-06-06', 'Female', '987 Cedar Lane','olivia2066'),
(7, 'Daniel Anderson', 'daniel.anderson@example.com', '2000-07-07', 'Male', '135 Walnut Drive','daniel2077'),
(8, 'Sophia Martinez', 'sophia.martinez@example.com', '2000-08-08', 'Female', '246 Birch Road','sophia2088'),
(9, 'Matthew Thomas', 'matthew.thomas@example.com', '2000-09-09', 'Male', '357 Willow Lane','matthew2099'),
(10, 'Ava Hernandez', 'ava.hernandez@example.com', '2000-10-10', 'Female', '468 Pinecone Avenue','ava201010');

INSERT INTO Results (result_id, result_student_id, result_exam_id, result_score)
VALUES
(1, 1, 1, 8.6),
(2, 1, 2, 7.5),
(3, 1, 3, 9),
(4, 1, 4, 8),
(5, 1, 5, 5),
(6, 2, 1, 8.8),
(7, 2, 2, 8),
(8, 2, 3, 6),
(9, 2, 4, 7),
(10, 2, 5, 8.5),
(11, 3, 1, 9.8),
(12, 3, 2, 9),
(13, 3, 3, 9.25),
(14, 3, 4, 6.6),
(15, 3, 5, 5.5),
(16, 4, 1, 7.8),
(17, 4, 2, 8),
(18, 4, 3, 7.75),
(19, 4, 4, 7.8),
(20, 4, 5, 6),
(21, 5, 1, 4.8),
(22, 5, 2, 5.23),
(23, 5, 3, 4.25),
(24, 5, 4, 9),
(25, 5, 5, 2),
(26, 6, 1, 6.6),
(27, 6, 2, 8.25),
(28, 6, 3, 9.5),
(29, 6, 4, 7),
(30, 6, 5, 6.5),
(31, 7, 1, 8.2),
(32, 7, 2, 8.75),
(33, 7, 3, 9.25),
(34, 7, 4, 1.8),
(35, 7, 5, 6.5),
(36, 8, 1, 7.8),
(37, 8, 2, 8.5),
(38, 8, 3, 7),
(39, 8, 4, 8.2),
(40, 8, 5, 4.5),
(41, 9, 1, 1.4),
(42, 9, 2, 8.5),
(43, 9, 3, 7.75),
(44, 9, 4, 9.0),
(45, 9, 5, 3.5),
(46, 10, 1, 8.8),
(47, 10, 2, 8.5),
(48, 10, 3, 8.0),
(49, 10, 4, 6.2),
(50, 10, 5, 8.25);

CREATE TABLE Blocks (
    block_id INT PRIMARY KEY,
    block_name VARCHAR(10)
);

CREATE TABLE Majors (
    major_id INT PRIMARY KEY,
    major_name VARCHAR(100)
);

CREATE TABLE Cutoff_Scores (
    major_id INT,
    block_id INT,
    cutoff_score FLOAT,
    PRIMARY KEY (major_id, block_id),
    FOREIGN KEY (major_id) REFERENCES Majors(major_id),
    FOREIGN KEY (block_id) REFERENCES Blocks(block_id)
);

CREATE TABLE Exam_Block (
    block_id INT,
    exam_id INT,
    PRIMARY KEY (block_id, exam_id),
    FOREIGN KEY (block_id) REFERENCES Blocks(block_id),
    FOREIGN KEY (exam_id) REFERENCES Exams(exam_id)
);

ALTER TABLE Students ADD block_name VARCHAR(10)

CREATE TABLE Major_Student(
	student_id INT,
	major_id INT,
	PRIMARY KEY( student_id,major_id),
	FOREIGN KEY (student_id) REFERENCES Students(student_id),
  FOREIGN KEY (major_id) REFERENCES Majors(major_id)
);

INSERT INTO Majors (major_id,major_name)
VALUES
(1,'Software Engineering'),
(2,'Data Science'),
(3,'Environmental technology'),
(4,'Chemical engineering'),
(5,'Safety Information'),
(6,'Printing technique'),
(7,'Business administration'),
(8,'Hotel management');

INSERT INTO Blocks (block_id,block_name)
VALUES
(1, 'A00'),
(2, 'A01'),
(3, 'D01'),
(4, 'D07');

INSERT INTO Exam_Block (block_id,exam_id)
VALUES
(1,1),
(1,2),
(1,3),
(2,1),
(2,2),
(2,4),
(3,1),
(3,4),
(3,5),
(4,1),
(4,3),
(4,4);

INSERT INTO Cutoff_Scores (major_id,block_id,cutoff_score)
VALUES
(1,1,29.30),
(1,2,28.80),
(2,1,28.00),
(2,2,28.5),
(3,1,25.00),
(3,2,25.25),
(4,1,25.45),
(4,3,25.75),
(5,1,27.80),
(5,2,28.00),
(6,1,24.50),
(6,3,24.9),
(7,4,23.00),
(8,4,23.55);

ALTER TABLE Major_Student ADD major_level INT CHECK(major_level IN (1,2,3,4,5));
alter table Students drop block_name;
CREATE TABLE student_blocks (
    student_id INT,
    block_id INT,
    PRIMARY KEY (student_id, block_id),
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    FOREIGN KEY (block_id) REFERENCES Blocks(block_id)
);
