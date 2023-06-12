<?php
function findLargestSquare($file_name) {
    // Lecture du fichier et création du plateau
    $lines = file($file_name, FILE_IGNORE_NEW_LINES);
    $num_lines = intval($lines[0]);
    $lines = array_slice($lines, 1);

    $grid = [];
    foreach ($lines as $line) {
        $grid[] = str_split($line);
    }

    // Initialisation de la matrice de calcul
    $memo = array_fill(0, $num_lines, array_fill(0, count($grid[0]), 0));

    // Remplissage de la première ligne et première colonne
    for ($i = 0; $i < $num_lines; $i++) {
        $memo[$i][0] = ($grid[$i][0] == '.') ? 1 : 0;
    }
    for ($j = 0; $j < count($grid[0]); $j++) {
        $memo[0][$j] = ($grid[0][$j] == '.') ? 1 : 0;
    }

    $max_size = 0;
    $max_i = 0;
    $max_j = 0;

    // Calcul de la taille du plus grand carré
    for ($i = 1; $i < $num_lines; $i++) {
        for ($j = 1; $j < count($grid[0]); $j++) {
            if ($grid[$i][$j] == '.') {
                $memo[$i][$j] = min($memo[$i - 1][$j - 1], $memo[$i][$j - 1], $memo[$i - 1][$j]) + 1;
                if ($memo[$i][$j] > $max_size) {
                    $max_size = $memo[$i][$j];
                    $max_i = $i;
                    $max_j = $j;
                }
            } else {
                $memo[$i][$j] = 0;
            }
        }
    }

    // Remplacement des '.' par 'x' pour représenter le plus grand carré possible
    for ($i = $max_i; $i > $max_i - $max_size; $i--) {
        for ($j = $max_j; $j > $max_j - $max_size; $j--) {
            $grid[$i][$j] = 'x';
        }
    }

    // Affichage du plateau modifié
    foreach ($grid as $line) {
        echo implode('', $line) . PHP_EOL;
    }
}
findLargestSquare("exemple_file.txt");