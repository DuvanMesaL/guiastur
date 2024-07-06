<?php

class GetRolesResponse{
    private $roles;
    public function __construct(array $roles){
        if ($roles === NULL) {
            $roles = array();
        }
        $this->roles = $roles;
    }
    public function getRoles() : array{
        return $this->roles;
    }
}


class RolResponse{
    private $id;
    private $nombre;
    private $descripcion;
    private $icono;

    public function __construct(int $id, string $nombre, string $descripcion = NULL, string $icono = NULL) {
        if($id === NULL || $id < 1) {
            throw new \InvalidArgumentException("El Id es requerido para Obtener los Roles");
        }
        if($nombre === NULL || empty(trim($nombre))) {
            throw new \InvalidArgumentException("El Nombre es requerido para Obtener los Roles");
        }

        $this->id = $id;
        $this->nombre = $nombre;    
        $this->descripcion = $descripcion;  
        $this->icono = $icono;
    }

    public function getId(): int { 
        return $this->id;
    }

    public function getNombre(): string {   
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIcono() {
        return $this->icono;
    }


}
