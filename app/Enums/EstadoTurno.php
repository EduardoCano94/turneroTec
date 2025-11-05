<?php

namespace App\Enums;

enum EstadoTurno: string
{
    case EN_ESPERA = 'EN_ESPERA';
    case YA_ATENDIDO = 'YA_ATENDIDO';
}
