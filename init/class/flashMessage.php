<?php

class flashMessage {

     //Message type
     private $messageType;
     //the message
     private $title;
     private $message;
     //I am the standard messages
     public  function sweetalert($typeicon, $title, $message, $timer = 1500)
     {
          return " Swal.fire({
           icon: '$typeicon',
           title:'$title' ,
           text:'$message' ,
           showConfirmButton: false,
           timer: $timer
           });";

     }
     private const standrMessageType = array("success", "warning", "primary", "danger", "info", "light", 'dark');
     /* Call the main function */
     /**
      * setMessage function
      *
      * @param [string] $message
      * @param [string] $messageType
      * @return void
      */

     public function setMessage($title, $message, $messageType)

     {
          $this->title = $title;
          $this->message = $message;
          $this->messageType = $messageType;
          $this->messageOption();

     }

     /* This function is responsible for selecting the message type */

     public function messageOption()

     {

          switch ($this->messageType) {
               case "success":
                    $this->success();
                    break;

               case "warning":
                    $this->warning();
                    break;

               case "question":
                    $this->question();
                    break;

               case "error":
                    $this->error();
                    break;

               case "info":
                    $this->info();
                    break;

          };

     }

     /*  I am messages */
     /**
      * Undocumented function
      *
      * @return void
      */

     private function success()
     {
          $_SESSION['success_message'] = $this->sweetalert('success', $this->title, $this->message);
     }

 

     private function warning()
     {
          $_SESSION['warning_message'] = $this->sweetalert('warning', $this->title, $this->message);
     }

     private function question()

     {
          $_SESSION['question_message'] = $this->sweetalert('question', $this->title, $this->message);
     }

     private function error()

     {
          $_SESSION['error_message'] = $this->sweetalert('error', $this->title, $this->message);
     }

 

     private function info()

     {
          $_SESSION['info_message'] = $this->sweetalert('info', $this->title, $this->message);
     }

 

     /* I am messages */

     /* This function is especially with the message*/

     public function printMessage()

     {
          if (isset($_SESSION['success_message'])) {
               echo $_SESSION['success_message'];
               $_SESSION['success_message'] = '';
          }

          if (isset($_SESSION['warning_message'])) {
               echo   $_SESSION['warning_message'];
               $_SESSION['warning_message'] = '';

          }

          if (isset($_SESSION['question_message'])) {
               echo $_SESSION['question_message'];
               $_SESSION['question_message'] = '';

          }

          if (isset($_SESSION['error_message'])) {
               echo $_SESSION['error_message'];
               $_SESSION['error_message'] = '';

          }

          if (isset($_SESSION['info_message'])) {
               echo $_SESSION['info_message'];
               $_SESSION['info_message'] = '';

          }

     }

};
