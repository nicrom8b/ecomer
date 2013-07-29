<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<ol>
	<li class="nav-header"> Categorias </li>
    <?php
        foreach ($rows as $row){
    ?>
        <li>
        	<a href="#"> 
            <?php
               echo JText::sprintf('CATEGORIES _LABEL', $row-> title);
            ?>
            </a>
        </li>
  <?php } ?>

</ol>