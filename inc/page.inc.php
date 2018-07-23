<?php


class Page {

    private $title = "";

    function header() {
      echo
        '<html>
        <head>

        </head>
        <body style="background-color: black;" id="particles-js">
        <script src="js/particles.js"></script>

        <script>
          particlesJS.load("particles-js", "assets/particles.json", function() {
          console.log("callback - particles.js config loaded");
          });
        </script>';



    }

    function footer() {

    }

    function tableChooser() {
        //Provide users ability to choose which table to access, probably using GET variables
    }

    function addForm($object){
        //Perhaps use http://php.net/manual/en/function.get-class.php to assess object name and use a switch statement based on that. Not needed if we make our objects have equal attributes

    }

    function editForm($objectData){

    }

    function displayData($objectClass) {

    }

}
?>
