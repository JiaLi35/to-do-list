<?php
// session start
session_start();

// require the functions file
    require "includes/functions.php";
/*
  decide what page to load depending on the url the user visit
  
  pages routes: 
    localhost:9000/ -> home.php
    localhost:9000/login -> login.php
    localhost:9000/signup -> signup.php
    localhost:9000/logout -> logout.php

  action routes: 
    localhost:9000/auth/login -> includes/auth/do_login.php
    localhost:9000/auth/signup -> includes/auth/do_signup.php
    localhost:9000/task/add -> includes/task/add_task.php
    localhost:9000/task/complete -> includes/task/completed_task.php
    localhost:9000/task/delete -> includes/task/delete_task.php

  */

  // global variable 
  // figure out what path the user is visiting
  $path = $_SERVER["REQUEST_URI"];
  // var_dump($path);

  // once you figure out the path, then we need to load relevant content based on the path 
  // require is like load this page
  switch ($path) {
    // pages routes
    case '/login':
      require "pages/login.php";
      break;
    
    case '/signup':
      require "pages/signup.php";
      break;

    case '/logout':
      require "pages/logout.php";
      break;
    
    default:
      require "pages/home.php";
      break;
    
    // action routes
    case '/auth/login':
      require "includes/auth/do_login.php";
      break;
    
    case '/auth/signup':
      require "includes/auth/do_signup.php";
      break;

    case '/task/add':
      require "includes/task/add_task.php";
      break;

    case '/task/delete':
      require "includes/task/delete_task.php";
      break;

    case '/task/complete':
      require "includes/task/complete_task.php";
      break;

  }