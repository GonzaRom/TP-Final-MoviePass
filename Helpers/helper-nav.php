<?php
use DAO\GenreDAO;
$genreDAO = new GenreDAO();
$listGenre = $genreDAO->getAll();
?>