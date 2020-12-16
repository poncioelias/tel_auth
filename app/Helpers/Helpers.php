<?php

namespace App\Helpers;

class Helpers
{
  /**
   * retorna html para gerar o loader
   *
   * @param string $content
   * @return void
   */
  public static  function screenLoader(string $content = null)
  {
    echo  "
      <div class='screenLoader white'>
        <div class='content'>
          <div class='loader'>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
          <div class='content'> $content </div>
        </div>
      </div>
    ";
  }


  public function jsonEncode($item)
  {
   return json_encode($item, JSON_UNESCAPED_UNICODE);
  }
}