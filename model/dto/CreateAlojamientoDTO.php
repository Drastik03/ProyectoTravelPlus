<?php
class CreateAlojamientoDTO {
    private int $id;
    private string $nombre;
    private string $descripcion;
    private int $capacidad;
    private float $precio;
    private string $ubicacion;
    private string $tipo;
    private int $disponible;
    private string $base_64;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getCapacidad(): int
    {
        return $this->capacidad;
    }

    public function setCapacidad(int $capacidad): void
    {
        $this->capacidad = $capacidad;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): void
    {
        $this->precio = $precio;
    }

    public function getUbicacion(): string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(string $ubicacion): void
    {
        $this->ubicacion = $ubicacion;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getDisponible(): int
    {
        return $this->disponible;
    }

    public function setDisponible(int $disponible): void
    {
        $this->disponible = $disponible;
    }

    public function getBase_64(): string
    {
        return $this->base_64;
    }

    public function setBase_64(string $base_64): void
    {
        $this->base_64 = $base_64;
    }


    
}