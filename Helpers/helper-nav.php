<?php
use DAO\GenreDAOMSQL as GenreDAOMSQL;
$genreDAO = new GenreDAOMSQL();
$listGenre = $genreDAO->getAll();
?>