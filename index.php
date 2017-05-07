<?php

  require_once('classes/Menu.php');

  $menu = new Menu();
  $tipo = 'sidebar';
  $sidebar = $menu->get_menu($tipo);

  build_menu($menu, $sidebar);
  dump($sidebar);

  function build_menu($menu,&$m) {
    foreach ($m as &$item) {
      $item['items'] = $menu->get_childrens($item['id']);
    }
  }

?>
