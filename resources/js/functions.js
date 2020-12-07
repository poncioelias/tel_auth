/**
 * envolve a pagina ou elemento com o loader
 * @param {*} content 
 * @param {*} style // white | black
 */
window.screenLoader = function(content = 'carregando...', style = '') {
    return `
  <div class='screenLoader ${style}'>
    <div class='content'>
      <div class='loader'>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
      <div class='content'> ${content} </div>
    </div>
  </div>
  `;
}

/**
 * remove o screenLoader
 */
window.removeScreenLoader = function() {
    $('.screenLoader').fadeOut();
    setTimeout(function() {
        $('.screenLoader').remove();
        $('.contentLoader').removeClass('contentLoader');
    }, 500)

}