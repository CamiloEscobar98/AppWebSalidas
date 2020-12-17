<?php
function checkAdministradorList($role)
{
    return ($role == 'administrador') ? 'col-xl-4' : 'col-xl-12';
}
function checkInputAdministrador($role)
{
    return ($role != 'administrador') ? 'disabled' : '';
}