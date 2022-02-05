<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

get('/', 'index.php');
get('/lab', 'lab.php');
get('/leaderboard', 'leaderboard.php');
get('/admin', 'admin/index.php');
get('/credit', 'credits.html');
get('/settings', 'settings.php');
get('/visual', 'visual_block.php');

// User Pages
get('/user/$userID', 'user.php');

// Problem Pages
get('/problems', 'problems.php');
get('/problem/$problemID', 'problem/index.php');
get('/problem/$problemID/submit', 'problem/submit.php');
get('/problem/$problemID/stats', 'problem/stats.php');
get('/problem/$problemID/set', 'problem/set.php');
get('/problem/$problemID/submissions', 'problem/submissions.php');

// Contest Pages
get('/contests', 'contests.php');
get('/contest/$contestID', 'contest/index.php');
get('/contest/$contestID/results', 'contest/results.php');
get('/contest/$contestID/set', 'contest/set.php');
get('/contest/$contestID/stats', 'contest/stats.php');
get('/contest/$contestID/submissions', 'contest/submissions.php');
get('/contest/$contestID/submit', 'contest/submit.php');

// Submission Pages
get('/submissions', 'submissions.php');
get('/submissions/own', 'mysubmissions.php');
get('/submission/$submissionID', 'submission/index.php');
get('/submission/$submissionID/details', 'submission/details.php');

// Admin Pages
get('/admin', 'admin/index.php');
get('/admin/contest', 'admin/contest.php');
get('/admin/problem', 'admin/problem.php');
get('/admin/sql', 'admin/sql.php');
get('/admin/user', 'admin/user.php');
get('/admin/visit', 'admin/visit.php');

any('/404', '404.php');

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
// get('/', 'index.php');

// Dynamic GET. Example with 1 variable
// The $id will be available in user.php
// get('/user/$id', 'user.php');

// Dynamic GET. Example with 2 variables
// The $name will be available in user.php
// The $last_name will be available in user.php
// get('/user/$name/$last_name', 'user.php');

// Dynamic GET. Example with 2 variables with static
// In the URL -> http://localhost/product/shoes/color/blue
// The $type will be available in product.php
// The $color will be available in product.php
// get('/product/$type/color/:color', 'product.php');

// Dynamic GET. Example with 1 variable and 1 query string
// In the URL -> http://localhost/item/car?price=10
// The $name will be available in items.php which is inside the views folder
// get('/item/$name', 'views/items.php');


// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
// any('/404','views/404.php');
