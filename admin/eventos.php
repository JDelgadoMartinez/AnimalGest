<?php
session_start();
include_once '../ModeloBD.php';
$conexiondb = new ModeloBD("animalgest");
$usuario = $_SESSION["conectado"];
if (!isset($usuario)) {
    echo "<script>
            alert ('No estás conectado')
            window.location = '../login.php';
        </script>";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Tu gestoría animal</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--JQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <!--Calendario-->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <!--Clockpicker-->
    <link rel="stylesheet" href="../css/bootstrap-clockpicker.css">
    <script src="../js/bootstrap-clockpicker.js"></script>

    <!--Bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>

    <style>
        #calendario {
            max-width: 1100px;
            margin: 40px auto;
        }

        a {
            color: black;
            text-decoration: none;
        }

        .fc th {
            vertical-align: middle;
            background: #f2f2f2;
        }

        .clockpicker-popover {
            z-index: 999999 !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var idCalendario = document.getElementById("calendario");
            var calendar = new FullCalendar.Calendar(idCalendario, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                dateClick: function(info) {
                    $("#agregar").toggle(true);
                    $("#borrar").toggle(false);
                    $("#modificar").toggle(false);

                    limpiarFormulario();
                    $("#txtFecha").val(info.dateStr);
                    $("#ModalEventos").modal("show");
                },
                /* Creamos un evento en el calendario (es un array al que se le pasan parametros
                Recibe los datos igual que un JSON, mediante clave:valor*/
                /*Creamos el eventSources para añadir estilo (entre otras cosas) a nuestros eventos (eliminado para mostrar lo que hay en bbdd)*/
                events: 'http://localhost:3000/admin/eventosBD.php',
                eventClick: function(info) {
                    $("#agregar").toggle(false);
                    $("#borrar").toggle(true);
                    $("#modificar").toggle(true);
                    //Mostramos titulo
                    $("#tituloEvento").html(info.event.title);
                    //Mostramos informacion evento
                    $('#txtID').val(info.event.extendedProps.idEvento);
                    $("#txtDescripcion").val(info.event.extendedProps.descripcion);
                    $("#txtTitulo").val(info.event.title);
                    $("#txtColor").val(info.event.extendedProps.color);
                    var fecha = moment(info.event.start).format('YYYY-MM-DD');
                    var hora = moment(info.event.start).format('HH:mm:ss');
                    $("#txtFecha").val(fecha);
                    $("#txtHora").val(hora);
                    $("#ModalEventos").modal("show");
                },
                editable: true, //Indicamos que el evento del calendario se podrá editar
                //Con esta función podremos dotar de movilidad al evento
                //Para ello, tendremos que pasar todos los valores del modal (para mantener los cambios en la nueva posición a la que se mueva)
                //NOTA: si solo llamamos a la funcion de recolectar() pero no recogemos sus datos, el DROP no se hará correctamente y volverá a su posición original
                eventDrop: function(info) {
                    $('#txtID').val(info.event.extendedProps.idEvento);
                    $("#txtTitulo").val(info.event.title);
                    $("#txtDescripcion").val(info.event.extendedProps.descripcion);
                    $("#txtColor").val(info.event.extendedProps.color);
                    var fecha = moment(info.event.start).format('YYYY-MM-DD');
                    var hora = moment(info.event.start).format('HH:mm:ss');
                    $("#txtFecha").val(fecha);
                    $("#txtHora").val(hora);
                    //Llamamos a la funcion que contiene todos los datos del modal
                    recolectar();
                    //aqui le indicamos que el parametro del modal que le pasamos a la funciòn será verdadero
                    enviarInformacionEvento('actualizar', NuevoEvento, true); //Como al final los campos se actualizarán, la accion a la que se le llama es "modificar"
                    location.reload();
                }

            });
            calendar.render();
            //Creamos variable para iniciarla con la informacion del evento
            var NuevoEvento;
            //AÑADIR nuevo evento
            $("#agregar").click(function() {
                recolectar();
                //Añadimos el objeto despues de llamar a la funcion que recolecta la informacion del evento para añadirla
                enviarInformacionEvento('agregar', NuevoEvento);
                $("#ModalEventos").modal("toggle");
                location.reload();
            });

            //BORRAR evento seleccionado
            $("#borrar").click(function() {
                recolectar();
                enviarInformacionEvento('eliminar', NuevoEvento);
                $("#ModalEventos").modal("toggle");
                location.reload();
            });

            //ACTUALIZAR evento seleccionado
            $("#modificar").click(function() {
                recolectar();
                enviarInformacionEvento('actualizar', NuevoEvento);
                $("#ModalEventos").modal("toggle");
                location.reload();
            });

            //Creamos funcion para cargar los datos de los eventos con el valor de cada uno de sus campos
            function recolectar() {
                NuevoEvento = {
                    id: $("#txtID").val(),
                    title: $("#txtTitulo").val(),
                    start: $("#txtFecha").val() + " " + $("#txtHora").val(),
                    color: $("#txtColor").val(),
                    descripcion: $("#txtDescripcion").val(),
                    textColor: "#FFFFFF",
                    end: $("#txtFecha").val() + " " + $("#txtHora").val(),
                }
            };

            //Creamos funcion para enviar la informacion de cada evento para poder hacer el CRUD
            function enviarInformacionEvento(accion, objetoEvento, modal) { //añadimos a la funcion el parametro del modal para poder moverlo con el evento DROP 
                //Vamos a recorrer cada uno de los elementos introducidos en la bbdd que tenemos en referencia al archivo eventosBD.php 
                //Para ello usamos Ajax
                $.ajax({
                    type: 'POST', //Metodo por el cual se enviaran los datos (puede ser GET)
                    url: 'http://localhost:3000/admin/eventosBD.php?accion=' + accion, //La url de donde van a sacar todos esos datos
                    //Como hay un switch dependiendo de la accion que queramos realizar, dicha accion se la pasamos a la url
                    data: objetoEvento, //Le indicamos los datos a enviar que va a ser los datos que se encuentran en el objeto
                    datatype: 'json',
                    success: function(msg) { //Esta funcion es lo que nos va a devolver nuestra respuesta del archivo eventoBD.php
                        if (msg) {
                            calendar.refetchEvents(); //Recorremos con refetch todos los eventos que existan
                            if (!modal) {
                                $("#ModalEventos").modal("toggle"); //Si no enviamos ningun modal, este no aparece (se ejecuta el if)
                            }

                        }
                    },
                    //Mostramos un error en caso de que ocurra algo
                    error: function() {
                        alert("Hay un error");
                    }
                });
            }
            $(".clockpicker").clockpicker();

            function limpiarFormulario() {
                $('#txtID').val("");
                $("#txtTitulo").val("");
                $("#txtDescripcion").val("");
                $("#txtColor").val("");
            }
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-light bg-light navbar-expand-lg">
        <img src="../img/AnimalGest.png" style="width:100px">
        <div class="topnav" id="navbarNav">
            <a class="nav-link" href="indexTrabajador.php">Inicio</a>
            <a class="nav-link" href="animalesAdmin.php">Gestión Animales</a>
            <a class="nav-link" href="desconexion.php">[Desconectarse]</a>
        </div>
    </nav>
    <div id="calendario"></div>
    <!-- Modal CRUD-->
    <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloEvento">Nuevo Evento</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--Creamos un div para que nos cargue la informacion añadida al evento-->
                    <input type="hidden" id="txtID" name="txtID">
                    <input type="hidden" id="txtFecha" name="txtFecha">
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label>Titulo:</label>
                            <input type="text" class="form-control" id="txtTitulo" placeholder="Titulo del Evento">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Hora del evento:</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" class="form-control" id="txtHora" value="12:30">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripcion:</label>
                        <textarea class="form-control" id="txtDescripcion" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Color:</label>
                        <input type="color" class="form-control" id="txtColor" value="#FF0000" style="height: 30px">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="agregar">Agregar</button>
                    <button type="button" class="btn btn-primary" id="modificar">Actualizar</button>
                    <button type="button" class="btn btn-danger" id="borrar">Borrar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="contact" id="contact" style="text-align: center; margin-top: 5%">
        <div class="container">
            <div class="contact-padding">
                <div class="footer">
                    <p>© 2024 All Rights Reserved | Design by Jose Javier Delgado Martinez</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("navbarNav");
            if (x.className === "navbar") {
                x.className += " responsive";
            } else {
                x.className = "navbar";
            }
        }
    </script>
</body>

</html>