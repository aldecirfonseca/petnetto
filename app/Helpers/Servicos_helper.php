<?php

/**
 * statusRegistro
 *
 * @param mixed $statusRegistro 
 * @return string
 */
function statusRegistro($statusRegistro)
{
    return match ((int)$statusRegistro) {
        1 => 'Ativo',
        0 => 'Inativo',
        default => 'Inativo',
    };
}
