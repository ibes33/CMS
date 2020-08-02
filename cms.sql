﻿-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: aug. 21, 2019 la 05:04 PM
-- Versiune server: 10.1.37-MariaDB
-- Versiune PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `cms`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'Javascript'),
(3, 'PHP'),
(4, 'Java'),
(17, 'CSS'),
(33, 'C++'),
(38, 'Phynton'),
(41, 'HTML5');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(7, 2, 'Boboc', 'sebi@gmail.com', 'dadada', 'approve', '2019-08-05'),
(8, 2, 'Cindy', 'boboc@yahoo.com', 'blabla', 'approve', '2019-08-05'),
(10, 2, 'mama', 'mama@yahoo.com', 'ceva text', 'approve', '2019-08-13'),
(15, 2, 'simo', 'simo@gmail.com', 'blabla', 'approve', '2019-08-14'),
(16, 46, 'da', 'sebi@gmail.com', 'dasda', 'approve', '2019-08-19'),
(18, 45, 'Boboc', 'boboc@yahoo.com', 'commboboc', 'approve', '2019-08-20');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_data` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_data`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(2, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-14', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 4, 'public', 0),
(3, 2, 'Javascript Master', 'Sebi', '', '2019-08-14', 'image_4.jpg', '<p>JavaScript is a dynamic computer programming language. It is lightweight and most commonly used as a part of web pages, whose implementations allow client-side script to interact with the user and make dynamic pages. It is an interpreted programming language with object-oriented capabilities. JavaScript was first known as LiveScript, but Netscape changed its name to JavaScript, possibly because of the excitement being generated by Java. JavaScript made its first appearance in Netscape 2.0 in 1995 with the name LiveScript. The general-purpose core of the language has been embedded in Netscape, Internet Explorer, and other web browsers.</p>', 'javascript,sebi,master', 1, 'public', 0),
(4, 41, 'HTML', 'Simo', '', '2019-08-14', 'image_2.jpg', '<p>BINE ACOLO</p>', 'html,simo', 0, 'public', 0),
(5, 17, 'CSS', 'Murarescu Sebi', '', '2019-08-16', 'image_2.jpg', '<p>ceva text text text text</p>', 'css, sebi', 0, 'public', 0),
(13, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-17', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(14, 2, 'Javascript Master', 'Sebi', '', '2019-08-17', 'image_4.jpg', '<p>JavaScript is a dynamic computer programming language. It is lightweight and most commonly used as a part of web pages, whose implementations allow client-side script to interact with the user and make dynamic pages. It is an interpreted programming language with object-oriented capabilities. JavaScript was first known as LiveScript, but Netscape changed its name to JavaScript, possibly because of the excitement being generated by Java. JavaScript made its first appearance in Netscape 2.0 in 1995 with the name LiveScript. The general-purpose core of the language has been embedded in Netscape, Internet Explorer, and other web browsers.</p>', 'javascript,sebi,master', 0, 'public', 0),
(15, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-17', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(16, 2, 'Javascript Master', 'Sebi', '', '2019-08-17', 'image_4.jpg', '<p>JavaScript is a dynamic computer programming language. It is lightweight and most commonly used as a part of web pages, whose implementations allow client-side script to interact with the user and make dynamic pages. It is an interpreted programming language with object-oriented capabilities. JavaScript was first known as LiveScript, but Netscape changed its name to JavaScript, possibly because of the excitement being generated by Java. JavaScript made its first appearance in Netscape 2.0 in 1995 with the name LiveScript. The general-purpose core of the language has been embedded in Netscape, Internet Explorer, and other web browsers.</p>', 'javascript,sebi,master', 0, 'public', 0),
(17, 41, 'HTML', 'Simo', '', '2019-08-17', 'image_2.jpg', '<p>BINE ACOLO</p>', 'html,simo', 0, 'public', 0),
(18, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-17', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(19, 2, 'Javascript Master', 'Sebi', '', '2019-08-17', 'image_4.jpg', '<p>JavaScript is a dynamic computer programming language. It is lightweight and most commonly used as a part of web pages, whose implementations allow client-side script to interact with the user and make dynamic pages. It is an interpreted programming language with object-oriented capabilities. JavaScript was first known as LiveScript, but Netscape changed its name to JavaScript, possibly because of the excitement being generated by Java. JavaScript made its first appearance in Netscape 2.0 in 1995 with the name LiveScript. The general-purpose core of the language has been embedded in Netscape, Internet Explorer, and other web browsers.</p>', 'javascript,sebi,master', 0, 'public', 0),
(20, 41, 'HTML', 'Simo', '', '2019-08-17', 'image_2.jpg', '<p>BINE ACOLO</p>', 'html,simo', 0, 'public', 0),
(21, 17, 'CSS', 'Murarescu Sebi', '', '2019-08-17', 'image_2.jpg', '<p>ceva text text text text</p>', 'css, sebi', 0, 'public', 0),
(22, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-17', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(23, 2, 'Javascript Master', 'Sebi', '', '2019-08-17', 'image_4.jpg', '<p>JavaScript is a dynamic computer programming language. It is lightweight and most commonly used as a part of web pages, whose implementations allow client-side script to interact with the user and make dynamic pages. It is an interpreted programming language with object-oriented capabilities. JavaScript was first known as LiveScript, but Netscape changed its name to JavaScript, possibly because of the excitement being generated by Java. JavaScript made its first appearance in Netscape 2.0 in 1995 with the name LiveScript. The general-purpose core of the language has been embedded in Netscape, Internet Explorer, and other web browsers.</p>', 'javascript,sebi,master', 0, 'public', 0),
(24, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-17', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(25, 2, 'Javascript Master', 'Sebi', '', '2019-08-17', 'image_4.jpg', '<p>JavaScript is a dynamic computer programming language. It is lightweight and most commonly used as a part of web pages, whose implementations allow client-side script to interact with the user and make dynamic pages. It is an interpreted programming language with object-oriented capabilities. JavaScript was first known as LiveScript, but Netscape changed its name to JavaScript, possibly because of the excitement being generated by Java. JavaScript made its first appearance in Netscape 2.0 in 1995 with the name LiveScript. The general-purpose core of the language has been embedded in Netscape, Internet Explorer, and other web browsers.</p>', 'javascript,sebi,master', 0, 'public', 0),
(26, 41, 'HTML', 'Simo', '', '2019-08-17', 'image_2.jpg', '<p>BINE ACOLO</p>', 'html,simo', 0, 'public', 0),
(27, 41, 'HTML', 'Simo', '', '2019-08-18', 'image_2.jpg', '<p>BINE ACOLO</p>', 'html,simo', 0, 'public', 0),
(28, 2, 'Javascript Master', 'Sebi', '', '2019-08-18', 'image_4.jpg', '<p>JavaScript is a dynamic computer programming language. It is lightweight and most commonly used as a part of web pages, whose implementations allow client-side script to interact with the user and make dynamic pages. It is an interpreted programming language with object-oriented capabilities. JavaScript was first known as LiveScript, but Netscape changed its name to JavaScript, possibly because of the excitement being generated by Java. JavaScript made its first appearance in Netscape 2.0 in 1995 with the name LiveScript. The general-purpose core of the language has been embedded in Netscape, Internet Explorer, and other web browsers.</p>', 'javascript,sebi,master', 0, 'public', 0),
(29, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-18', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(30, 2, 'Javascript Master', 'Sebi', '', '2019-08-18', 'image_4.jpg', '<p>JavaScript is a dynamic computer programming language. It is lightweight and most commonly used as a part of web pages, whose implementations allow client-side script to interact with the user and make dynamic pages. It is an interpreted programming language with object-oriented capabilities. JavaScript was first known as LiveScript, but Netscape changed its name to JavaScript, possibly because of the excitement being generated by Java. JavaScript made its first appearance in Netscape 2.0 in 1995 with the name LiveScript. The general-purpose core of the language has been embedded in Netscape, Internet Explorer, and other web browsers.</p>', 'javascript,sebi,master', 0, 'public', 0),
(31, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-18', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(32, 17, 'CSS', 'Murarescu Sebi', '', '2019-08-18', 'image_2.jpg', '<p>ceva text text text text</p>', 'css, sebi', 0, 'public', 0),
(33, 41, 'HTML', 'Simo', '', '2019-08-18', 'image_2.jpg', '<p>BINE ACOLO</p>', 'html,simo', 0, 'public', 0),
(34, 2, 'Javascript Master', 'Sebi', '', '2019-08-18', 'image_4.jpg', '<p>JavaScript is a dynamic computer programming language. It is lightweight and most commonly used as a part of web pages, whose implementations allow client-side script to interact with the user and make dynamic pages. It is an interpreted programming language with object-oriented capabilities. JavaScript was first known as LiveScript, but Netscape changed its name to JavaScript, possibly because of the excitement being generated by Java. JavaScript made its first appearance in Netscape 2.0 in 1995 with the name LiveScript. The general-purpose core of the language has been embedded in Netscape, Internet Explorer, and other web browsers.</p>', 'javascript,sebi,master', 0, 'public', 0),
(35, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-18', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(36, 41, 'HTML', 'Simo', '', '2019-08-18', 'image_2.jpg', '<p>BINE ACOLO</p>', 'html,simo', 0, 'public', 0),
(37, 2, 'Javascript Master', 'Sebi', '', '2019-08-18', 'image_4.jpg', '<p>JavaScript is a dynamic computer programming language. It is lightweight and most commonly used as a part of web pages, whose implementations allow client-side script to interact with the user and make dynamic pages. It is an interpreted programming language with object-oriented capabilities. JavaScript was first known as LiveScript, but Netscape changed its name to JavaScript, possibly because of the excitement being generated by Java. JavaScript made its first appearance in Netscape 2.0 in 1995 with the name LiveScript. The general-purpose core of the language has been embedded in Netscape, Internet Explorer, and other web browsers.</p>', 'javascript,sebi,master', 0, 'public', 0),
(38, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-18', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(40, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-18', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(41, 17, 'CSS', 'Murarescu Sebi', '', '2019-08-18', 'image_2.jpg', '<p>ceva text text text text</p>', 'css, sebi', 0, 'public', 0),
(44, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-18', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(45, 1, 'Bootstrap tare', 'Murarescu Sebi', '', '2019-08-19', 'image_3.jpg', '<p>Bootstrap includes user interface components, layouts and JS tools along with the framework for implementation. The software is available precompiled or as source code. Mark Otto and Jacob Thornton developed Bootstrap at Twitter as a means of improving the consistency of tools used on the site and reducing maintenance. The software was formerly known as Twitter Blueprint and is sometimes referred to as Twitter Bootstrap.</p>', 'bootstrap,edwin', 0, 'public', 0),
(46, 17, 'CSS', 'Murarescu Sebi', '', '2019-08-20', 'image_2.jpg', '<p>ceva text text text text</p>', 'css, sebi', 0, 'public', 5),
(49, 1, 'das', '1', '', '2019-08-20', 'image_1.jpg', '<p>dsa</p>', 'dsa', 0, 'public', 1),
(50, 1, 'da', 'test', 'test', '2019-08-20', 'image_1.jpg', '<p>da</p>', 'da', 0, 'public', 4);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(1, 'rico', '123', 'suzve', 'ciro', 'rico@gmail.com', '', 'admin', ''),
(7, 'test', 'test', 'testF', 'testL', 'test@gmail.com', '', 'admin', ''),
(10, 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', '', 'admin', ''),
(66, 'admin', '$2y$12$jkuYRUaFRKpHk6N1E/USUO5yvpNlpDi0UcLEqucx9nahuOmRe1DZ.', 'admin', 'admin', 'admin@yahoo.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(72, 'test', '$2y$12$AiHroOXGZNtJpnYBaANNCugTF11X1VoV0YMUha3KCsi9dFSY.LmkO', '', '', 'test@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users_online`
--

CREATE TABLE `users_online` (
  `id` int(3) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(16, 'dp20ncgfljevae6fk77ou63ptq', 1566398774);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexuri pentru tabele `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexuri pentru tabele `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexuri pentru tabele `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pentru tabele `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pentru tabele `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pentru tabele `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;