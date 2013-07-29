<ul class="nav nav-list">
    
        <li class="nav-header"> Categorias </li>
        <?php
        foreach ($rows as $row){ ?>

        <li>
          <a href="index.php?option=com_publico&task=categoriaProducto&id=<?echo $row->id; ?>"> 
          <?php
               echo JText::sprintf('CATEGORY_LABEL', $row->nombre);
          ?>
          </a>
        </li>
  <?php
        }
  ?>
</ul>