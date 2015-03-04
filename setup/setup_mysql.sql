-- phpMyAdmin SQL Dump
-- version 2.6.3-pl1
-- http://www.phpmyadmin.net
-- 
-- Host: telecomsetreseauxtwn.sql.free.fr
-- Generation Time: Jan 14, 2007 at 04:53 PM
-- Server version: 5.0.27
-- PHP Version: 4.4.4
-- 
-- Database: `telecomsetreseauxtwn`
-- 
CREATE DATABASE `telecomsetreseauxtwn` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE telecomsetreseauxtwn;

-- --------------------------------------------------------

-- 
-- Table structure for table `files`
-- 

CREATE TABLE `files` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `path` varchar(38) NOT NULL default '',
  `author` varchar(20) default NULL,
  `comment` varchar(76) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=335 DEFAULT CHARSET=latin1 AUTO_INCREMENT=335 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `nodes`
-- 

CREATE TABLE `nodes` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `nextnode` smallint(5) unsigned NOT NULL default '0',
  `childnode` smallint(5) unsigned NOT NULL default '0',
  `contenttype` tinyint(3) unsigned NOT NULL default '0',
  `contentid` smallint(5) unsigned NOT NULL default '0',
  `permissions` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `nextnode` (`nextnode`),
  KEY `childnode` (`childnode`)
) ENGINE=MyISAM AUTO_INCREMENT=504 DEFAULT CHARSET=latin1 AUTO_INCREMENT=504 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `permissions`
-- 

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(32) collate latin1_general_ci NOT NULL,
  `password` varchar(32) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `sections`
-- 

CREATE TABLE `sections` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `title` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=169 DEFAULT CHARSET=latin1 AUTO_INCREMENT=169 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `stats`
-- 

CREATE TABLE `stats` (
  `id` int(11) NOT NULL auto_increment,
  `whn` datetime NOT NULL,
  `file` varchar(128) collate latin1_general_ci NOT NULL,
  `usr_ip` varchar(32) collate latin1_general_ci NOT NULL,
  `usr_hostname` varchar(256) collate latin1_general_ci NOT NULL,
  `usr_agent` varchar(256) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `whn` (`whn`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;
