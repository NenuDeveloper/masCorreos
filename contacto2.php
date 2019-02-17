<?php 
    if(isset($_POST['nombrecontacto']) 
    && isset($_POST['correocontacto']) 
    && isset($_POST['asuntocontacto'])
    && isset($_POST['telefonocontacto'])
    && isset($_POST['mensajecontacto'])
    && filter_var($_POST['correocontacto'])){


        // detect & prevent header injections
        $test = "/(content-type|bcc:|cc:|to:)/i";
        foreach ( $_POST as $key => $val ) {
            if ( preg_match( $test, $val ) ) {
            exit;
            }
        }


        //Honey POT
        if(!empty($_POST['fax'])) {
            http_response_code(400);
            echo 'Error';
            exit;
        }else {
            $para = 'correodecarlosrg@hotmail.com';
            $mensaje = "Nombre: "
            . $_POST['nombrecontacto']
            . ' - Email: '
            . $_POST['correocontacto']
            . ' - Teléfono: '
            . $_POST['telefonocontacto']
            . '- Mensaje: ' 
            . $_POST['mensajecontacto'];

            $titulo = $_POST['asuntocontacto'];


            $headers = 'From: ' . $_POST["nombrecontacto"] . '<' . $_POST["correocontacto"] . '>' . "\r\n" .
            'Reply-To: ' . $_POST["correocontacto"] . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            mail($para, $titulo, $mensaje, $headers);

            //Redirect to index.html
            header("Location: /mascorreos", true, 301);
            exit();

        }



    }else{
        echo 'Llena correctamente los campos <a href="/mascorreos">Regresar</a>';
    }
?>