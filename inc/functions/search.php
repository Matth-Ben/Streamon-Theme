<?php
/**
 * Created by PhpStorm.
 * User: mathias
 * Date: 18/06/18
 * Time: 12:45
 */
?>

<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/" class="form-inline my-2 my-lg-0">
    <div>
        <input class="form-control mr-sm-2" type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="searchsubmit" value="Chercher" >Chercher</button>
    </div>
</form>
