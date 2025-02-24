<?php

class ValidarCodigoContra {
    
    
    public function __construct() {
    }
    
    public function validarCodigo($codigo,$con) {
        $stmt = $con->getConexion()->query("SELECT * FROM verificaciones WHERE codigo = '$codigo' AND activo = '1'");

        return $stmt->num_rows > 0;


        
        
          
        
    }
}
?>