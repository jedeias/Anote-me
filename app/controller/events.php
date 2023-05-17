<?php

interface events extends eventsGeneric, eventsPacientes, eventsPsicologos, eventsSecretarios{

}

interface eventsPacientes{
    public function getEventosPaciente($id);
}

interface eventsPsicologos{
    public function getEventosPsicologo($id);
}

interface eventsSecretarios{

}

interface eventsGeneric{

}

?>