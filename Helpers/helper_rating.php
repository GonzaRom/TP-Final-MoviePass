<?php 
namespace Helpers;

class helper_rating{
    
    public static function showRating($rating)
    {
        echo '<small class="card-text">';
        $rating = $rating / 2;
        for ($i = 1; $i <= 5; $i++) {
            if ($rating < $i) {
                if (is_float($rating) && (round($rating) == $i)) {
                    echo '<i class="fas fa-star-half-alt"></i>';
                } else {
                    echo '<i class="far fa-star"></i>';
                }
            } else {
                echo '<i class="fas fa-star "></i>';
            }
        }
        echo '</small>';
    }
}
?>