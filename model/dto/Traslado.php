<?php
// AUTHOR: MOSQUERA VERGARA GEORGE ARIEL
class Traslado{
    private int $id;
    private string $origen;
    private string $destino;
    private string $fecha_recogida; 
    private string $hora_recogida;   
    private int $cantidad_pasajeros;
    private float $precio;


    public function __construct(int $id, string $origen, string $destino, string $fecha_recogida, string $hora_recogida, int $cantidad_pasajeros, float $precio) {
        $this->id = $id;
        $this->origen = $origen;
        $this->destino = $destino;
        $this->fecha_recogida = $fecha_recogida;
        $this->hora_recogida = $hora_recogida;
        $this->cantidad_pasajeros = $cantidad_pasajeros;
        $this->precio = $precio;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void { 
        $this->id = $id;
    }

    public function getOrigen(): string {
        return $this->origen;
    }

    public function setOrigen(string $origen): void {
        $this->origen = $origen;
    }

    public function getDestino(): string {
        return $this->destino;
    }

    public function setDestino(string $destino): void {
        $this->destino = $destino;
    }

    public function getFechaRecogida(): string {
        return $this->fecha_recogida;
    }

    public function setFechaRecogida(string $fecha_recogida): void {
        $this->fecha_recogida = $fecha_recogida;
    }

    public function getHoraRecogida(): string {
        return $this->hora_recogida;
    }

    public function setHoraRecogida(string $hora_recogida): void {
        $this->hora_recogida = $hora_recogida;
    }

    public function getCantidadPasajeros(): int {
        return $this->cantidad_pasajeros;
    }

    public function setCantidadPasajeros(int $cantidad_pasajeros): void {
        $this->cantidad_pasajeros = $cantidad_pasajeros;
    }

    public function getPrecio(): float {
        return $this->precio;
    }

    public function setPrecio(float $precio): void {
        $this->precio = $precio;
    }
}
?>