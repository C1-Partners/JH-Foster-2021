
// populates the gform Event Sign-Up hidden title field with the event name 
document.addEventListener('DOMContentLoaded', function(event) {

    title = window.eventTitle;

    if(title) {

        function populateEventForm() {
            //get event title passed to window obj from php 
            let eventTitle = window.eventTitle;
            //populate hidden field on page load
            document.getElementById('input_2_5').value = eventTitle;
        }
    
        populateEventForm();
    }
  
})
