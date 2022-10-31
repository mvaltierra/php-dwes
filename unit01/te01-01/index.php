<?php

    /****** ESTABLECIMIENTO DE LA ZONA HORARIA *******/
    date_default_timezone_set("Europe/Madrid");

    /****** FUNCIONES ********/

    // @Función para calcular la fecha de devolución del libro
    function sumDays($date){
        return date("d/m/Y",strtotime($date."10 days"));
    }

    // @Función para el cálculo de la letra correcta del dni
    function correctLetter($dni) {

        $letters = array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E');
        
        $dniNumbers = substr($dni, 0, -1);

        $numberLetterToSearch = $dniNumbers%23;
        
        for ($i = 0; $i <= count($letters); $i++){
                
            if($numberLetterToSearch == $i){
                $correctLetter = $letters[$i];
            }
        }

            return $correctLetter;
    }



    // Variables 

    $name = $surname = $titleBook = $email = $dni = ''; 

    $message = '';
    $mailMessage = '';
    $mailValidated = '';
    $dateMessage = '';
    $dateValidated = '';
    $titleMessage = '';
    $dniMessage = '';
    $dniValidated = '';
        
    
    /*** VALIDACIÓN FORMULARIO ***/
    if( isset($_POST['submit']) ) {

        // Validación datos textos
        if ( empty($_POST['titleBook']) ) {
            $message = "Título del libro es requerido <br/>";
        } else {
            $title = $_POST['titleBook'];
            $message = $title;
        }

        // Validación email
        if ( empty($_POST['email']) ) {
            $mailMessage = "Dirección email es requerida.<br/>";
        } else {
            $email = $_POST['email'];
            if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
                $mailMessage = "Dirección email debe ser válida.<br/>";
            } else {
                $mailValidated = "Email válido. $email";
            }
        }
        
        // Validación fecha
        if ( empty($_POST['borrowDate']) ){
            $dateMessage = "La fecha es requerida <br/>";
        } else {
            $date = $_POST['borrowDate'];
            $finalDate = sumDays($date);
            $dateValidated = "Fecha devolución: " . $finalDate;
        } 

        // Validación dni
        if ( empty($_POST['dni']) ){
            $dniMessage = "DNI es requerido <br/>";
        } else {
            $dni = $_POST['dni'];

            $dniLetterValidated = correctLetter($dni);

            if (strlen($dni) != 9 || $dniLetterValidated != substr($dni, -1)) {
                $dniMessage =  "Dni incompleto o letra no correcta";
            }
            

            if ( $dniLetterValidated == substr($dni, -1) ) {
                $dniValidated = "Dni correcto: " . $dni;
            }  
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit01 - te01</title>
</head>
<body>
    <header>
        <h1>Préstamo de libros</h1>
    </header>
    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">

            <div class="form-item">
                <label for="name">Nombre</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <p class="error"><?php $message ?></p>
            </div>
            
            <div class="form-item">
                <label for="surname">Apellidos</label>
                <input type="text" name="surname" value="<?php echo htmlspecialchars($surname); ?>">
                <p class="error"><?php $message?></p>
            </div>
            
            <div class="form-item">
                <label for="titleBook">Libro</label>
                <input type="text" name="titleBook" value="<?php echo htmlspecialchars($titleBook); ?>">
                <p class="error"><?php $message ?></p>
            </div>
            
            <div class="form-item">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <p class="error"><?php echo $mailMessage; ?></p>
            </div>
            
            <div class="form-item">
                <label for="borrowDate">Fecha Alquiler</label>
                <input type="date" name="borrowDate" value="<?php echo htmlspecialchars(date("Y-m-d")); ?>">
                <p class="error"><?php echo $dateMessage; ?></p>
            </div>
            
            <div class="form-item">
                <label for="dni">DNI</label>
                <input type="text" name="dni" value="<?php echo htmlspecialchars($dni); ?>">
                <p class="error"><?php echo $dniMessage ?></p>
            </div>
            
            <button type="submit" name="submit">Enviar</button>
        </form>
        <br>
        <div class="confirmations">
            <?php 
                echo "<p class='validated'>$mailValidated</p>";
                echo "<p class='validated'>$dateValidated</p>";
                echo "<p class='validated'>$dniValidated</p>";
            ?>
        </div>
    </main>
    <footer></footer>
</html>