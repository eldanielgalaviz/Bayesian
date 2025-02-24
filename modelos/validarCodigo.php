<?php

class ValidadorCodigo {
    
    private $conexion;
    
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    
    public function validarCodigo($usuario, $codigo) {
        
        $stmt = $this->conexion->getConexion()->query("SELECT codigoEmail FROM usuarios WHERE usuario = '$usuario'");
        $resultado = $stmt->fetch_assoc()['codigoEmail'];        
        return $codigo == $resultado;
          
        
    }
}


?>