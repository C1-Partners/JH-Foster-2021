// adjusts inner block padding based on height of heading
document.addEventListener('DOMContentLoaded', function() {

    const blockQuote = document.getElementById('blockQuote');
       
    if(!blockQuote) {
      return
    }

    const heading = document.getElementById('qHeading'),
          blockQuoteInner = document.getElementById('qBlockquote');

    if (heading) {
        const headingHeight = heading.offsetHeight;
        blockQuoteInner.style.marginTop = headingHeight + 'px';
    }
})