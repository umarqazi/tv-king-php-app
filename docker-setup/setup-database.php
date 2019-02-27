<?php
$DB_NAME = 'tv_king_db';
$sql = "DROP DATABASE if exists $DB_NAME";
$sql = "CREATE DATABASE $DB_NAME DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";