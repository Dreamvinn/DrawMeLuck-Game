<?php 
	try {
		
		$db_host   	= 'localhost';
		$db_user   	= 'root';
		$db_pass   	= '';
		$db_name 	= 'drawmeluck';

		// INITIALIZE CONNECTION OFFLINE
		$conn = new mysqli($db_host, $db_user, $db_pass);
		$conn->query("CREATE DATABASE IF NOT EXISTS `$db_name`");
		$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

		$conn->query("CREATE TABLE IF NOT EXISTS `classes` (
				`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				`section` varchar(50) DEFAULT NULL,
				`subject` varchar(60) DEFAULT NULL,
				`teacherId` varchar(50) DEFAULT NULL
				)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

		$conn->query("CREATE TABLE IF NOT EXISTS `students` (
				`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				`name` varchar(50) DEFAULT NULL,
				`classId` varchar(60) DEFAULT NULL,
				`teacherId` varchar(50) DEFAULT NULL
				)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

		$conn->query("CREATE TABLE IF NOT EXISTS `groups` (
				`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				`name` varchar(50) DEFAULT NULL,
				`studentId` varchar(50) DEFAULT NULL,
				`classId` varchar(60) DEFAULT NULL,
				`teacherId` varchar(50) DEFAULT NULL
				)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

		$conn->query("CREATE TABLE IF NOT EXISTS `teachers` (
				`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				`username` varchar(50) DEFAULT NULL,
				`password` varchar(60) DEFAULT NULL
				)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

		$conn->query("CREATE TABLE IF NOT EXISTS `scoreboard` (
				`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				`groupId` varchar(50) DEFAULT NULL,
				`game_points` int(50) DEFAULT NULL,
				`perk_points` int(60) DEFAULT NULL,
				`classId` varchar(50) DEFAULT NULL,
				`teacherId` varchar(60) DEFAULT NULL
				)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

		$conn->query("CREATE TABLE IF NOT EXISTS `finalscore` (
				`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				`groupId` varchar(50) DEFAULT NULL,
				`final_score` int(50) DEFAULT NULL,
				`classId` varchar(50) DEFAULT NULL,
				`teachersId` varchar(60) DEFAULT NULL,
				`gameId` varchar(60) DEFAULT NULL
				)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
				
	} catch (\PDOException $th) {
		echo "Connection failed : " . $e->getMessage();
		$conn = null;
		return;
	}
?>