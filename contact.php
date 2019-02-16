<?php
   if(isset($_POST['nombre']) && isset($_POST['correo']) && 
        isset($_POST['telefono']) && filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {

             // detect & prevent header injections
            $test = "/(content-type|bcc:|cc:|to:)/i";
            foreach ( $_POST as $key => $val ) {
                if ( preg_match( $test, $val ) ) {
                exit;
                }
            }

            //Honey Pot
            if(!empty($_POST['fax'])) {
                http_response_code(400);
                exit;
            }else {
                
                $para = 'nenust1@outlook.com';
                $mensaje = 'Brindar información mas correos,'
                    . "\n Nombre: "
                    . $_POST['nombre']
                    . '\n Email: '
                    . $_POST['correo']
                    . '\n Teléfono: '
                    . $_POST['telefono'];

                $titulo = 'Información Máscorreos.com';

                $headers = 'From: ' . $_POST["nombre"] . '<' . $_POST["correo"] . '>' . "\r\n" .
                    'Reply-To: ' . $_POST["correo"] . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($para, $titulo, $mensaje, $headers);

            }


   }

?>