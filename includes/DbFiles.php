<?php
/**
 * Created by PhpStorm.
 * User: Balaji
 * Date: 03-09-2018
 * Time: 10:57 AM
 */

//-- phpMyAdmin SQL Dump
//-- version 4.7.7
//-- https://www.phpmyadmin.net/
//--
//-- Host: localhost:3306
//-- Generation Time: Sep 03, 2018 at 05:24 AM
//-- Server version: 10.1.31-MariaDB
//-- PHP Version: 7.0.26
//
//SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
//SET AUTOCOMMIT = 0;
//START TRANSACTION;
//SET time_zone = "+00:00";
//
//
///*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
///*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
///*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
///*!40101 SET NAMES utf8mb4 */;
//
//--
//-- Database: `id5749207_mydatabase`
//--
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `admin`
//--
//
//CREATE TABLE `admin` (
//`id` int(11) NOT NULL,
//  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
//  `mobile_No` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
//  `email_Id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
//  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
//
//--
//-- Dumping data for table `admin`
//--
//
//INSERT INTO `admin` (`id`, `name`, `mobile_No`, `email_Id`, `password`) VALUES
//(1, 'admin', '8886259252', 'pusuluribalaji66@gmail.com', 'MTIzNDU='),
//(2, 'kiran', '7989850438', 'kir@gmail.com', 'a2lyYW4='),
//(3, 'a', '12345678901', 'a@gmail.com', 'MTIzNDU=');
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `status`
//--
//
//CREATE TABLE `status` (
//`id` int(11) NOT NULL,
//  `status` int(10) NOT NULL,
//  `date` date NOT NULL,
//  `student_id` int(20) DEFAULT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
//
//--
//-- Dumping data for table `status`
//--
//
//INSERT INTO `status` (`id`, `status`, `date`, `student_id`) VALUES
//(1, 1, '2018-06-30', 1001),
//(5, 1, '2018-07-01', 1002),
//(17, 1, '2018-07-02', 1002),
//(20, 0, '2018-07-02', 1001),
//(21, 1, '2018-07-03', 1001),
//(22, 1, '2018-07-09', 1002),
//(23, 1, '2018-07-30', 1001);
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `student`
//--
//
//CREATE TABLE `student` (
//`id` int(20) NOT NULL,
//  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
//  `class` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
//  `mobile_No` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
//  `email_Id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
//  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
//  `date_Of_Birth` date NOT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
//
//--
//-- Dumping data for table `student`
//--
//
//INSERT INTO `student` (`id`, `name`, `class`, `mobile_No`, `email_Id`, `password`, `date_Of_Birth`) VALUES
//(1001, 'balaji', '9th', '8886259252', 'pusuluribalaji81@gmail.com', 'MTIzNDU=', '0000-00-00'),
//(1002, 'vivek', '9th', '7989850438', 'pusuluribalaji66@gmail.com', 'MTIzNDU2', '1994-12-27'),
//(1003, 'rohit', '10th', '6388784659', 'rohit9075@gmail.com', 'MTIzNDU=', '1992-11-24'),
//(1004, 'silajit', '10th', '9584726855', 'silajit42@gmail.com', 'MTIzNDU=', '1988-11-24'),
//(1005, 'ramesh', '10th', '9685236524', 'ramesh@gmail.com', 'MTIzNDU=', '1990-11-02');
//
//-- --------------------------------------------------------
//
//--
//-- Table structure for table `users`
//--
//
//CREATE TABLE `users` (
//`id` int(11) NOT NULL,
//  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
//  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
//  `password` text COLLATE utf8_unicode_ci NOT NULL,
//  `gender` varchar(6) COLLATE utf8_unicode_ci NOT NULL
//) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
//
//--
//-- Dumping data for table `users`
//--
//
//INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`) VALUES
//(1, 'balaji', 'b@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'male'),
//(2, 'balaji', 'b1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'male'),
//(3, 'balaji', 'b2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'male'),
//(4, 'rohit', 'rohit@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'male');
//
//--
//-- Indexes for dumped tables
//--
//
//--
//-- Indexes for table `admin`
//--
//ALTER TABLE `admin`
//  ADD PRIMARY KEY (`id`);
//
//--
//-- Indexes for table `status`
//--
//ALTER TABLE `status`
//  ADD PRIMARY KEY (`id`),
//  ADD KEY `student_id_fk` (`student_id`);
//
//--
//-- Indexes for table `student`
//--
//ALTER TABLE `student`
//  ADD PRIMARY KEY (`id`);
//
//--
//-- Indexes for table `users`
//--
//ALTER TABLE `users`
//  ADD PRIMARY KEY (`id`);
//
//--
//-- AUTO_INCREMENT for dumped tables
//--
//
//--
//-- AUTO_INCREMENT for table `admin`
//--
//ALTER TABLE `admin`
//  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
//
//--
//-- AUTO_INCREMENT for table `status`
//--
//ALTER TABLE `status`
//  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
//
//--
//-- AUTO_INCREMENT for table `users`
//--
//ALTER TABLE `users`
//  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
//
//--
//-- Constraints for dumped tables
//--
//
//--
//-- Constraints for table `status`
//--
//ALTER TABLE `status`
//  ADD CONSTRAINT `student_id_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);
//COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
