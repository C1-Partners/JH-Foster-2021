
/*
 *   Populates hidden field of the gform on products pages with checkbox selections.  
 *   
 */ 
jQuery(document).ready(function () {

    
    const gform = document.getElementById('gform_wrapper_3');

    if(!gform) {
        return;
    }
       
    let $checkboxes = $('[type="checkbox"]:not("#choice_7_select_all")');
    let inputURL = $('#input_3_8');
    let checkboxesArray = [].slice.call($checkboxes);
    let $output = $('#input_3_9');
    let $url = window.location.href;
    let values = [];
    
    $checkboxes.on('change', () => {
    values = checkboxesArray
        .filter((checkbox) => checkbox.checked)
        .map((checkbox) => checkbox.value);
    
        $output[0].value = values;
    });

    inputURL[0].value = $url;

   
  });

