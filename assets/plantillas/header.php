<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="icon" type="image/png" href="/img/DB_16х16.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de gestion de proyectos</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">


    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">


    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,100,700,900' rel='stylesheet'type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- inject:css -->
    <link rel="stylesheet" href="/vendor/datatables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/assets/css/dashboard/getmdl-select.min.css">
    <link rel="stylesheet" href="/assets/css/dashboard/nv.d3.css">
    <link rel="stylesheet" href="/assets/css/dashboard/application.css">
    <link rel="stylesheet" href="/assets/css/dashboard/header.css">
    <link rel="stylesheet" href="/assets/css/dashboard/scroll.css">
    <link rel="stylesheet" href="/assets/css/dashboard/modal.css">
    <link rel="stylesheet" href="/assets/css/dashboard/link.css">
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/components-font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/vendor/notyf/dist/notyf.min.css">
    <link rel="stylesheet" href="/assets/css/dashboard/tables.css">
    <link rel="stylesheet" href="/vendor/jquery-progresstimer/dist/css/jquery.progresstimer.min.css">
    <!-- endinject -->

</head>
<body>
<!-- Modal -->
<div id="modal-add-user-data" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Datos del usuario</h4>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="loading-progress"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Cedula</label>
                    <input id="id" type="number" class="form-control"/>
                    <label>Primer Nombre</label>
                    <input id="first_name" type="text" class="form-control"/>
                    <label>Segundo Nombre</label>
                    <input id="second_name" type="text" class="form-control"/>
                    <label>Primer Apellido</label>
                    <input id="surname" type="text" class="form-control"/>
                    <label>Segundo Apellido</label>
                    <input id="second_surname" type="text" class="form-control"/>
                    <label>Email</label>
                    <input id="email" type="email" class="form-control"/>
                    <label>Nombre de usuario</label>
                    <input id="username" type="text" class="form-control"/>
                    <label>Contraseña</label>
                    <input id="password" type="password" class="form-control"/>
                    <label>Telefono</label>
                    <input id="phone" type="number" class="form-control"/>
                    <label>Dirección</label>
                    <textarea id="address" class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <label>Roles</label>
                    <select id="rols" class="form-control select2" style="width: 100%;">
                    </select>
                    <table id="table-modal" class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="color:white;">Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button id="addUser" type="button" class="btn btn-default modal-btn">Guardar</button>
            <button id="cancel" type="button" class="btn btn-default modal-btn" data-dismiss="modal">Cerrar</button>
        </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header is-small-screen">
    <header class="mdl-layout__header mdl-layout__header--transparent">
        <div class="mdl-layout__header-row">
            <div class="mdl-layout-spacer"></div>
            <!-- Search-->
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                    <i class="material-icons">search</i>
                </label>

                <div class="mdl-textfield__expandable-holder">
                    <input class="mdl-textfield__input" type="text" id="search"/>
                    <label class="mdl-textfield__label" for="search">Enter your query...</label>
                </div>
            </div>

            <div class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="notification" data-badge="23">
                notifications_none
            </div>
            <!-- Notifications dropdown-->
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right mdl-shadow--2dp notifications-dropdown" for="notification">
                <li class="mdl-list__item">
                    You have 23 new notifications!
                </li>
                <li class="mdl-menu__item mdl-list__item list__item--border-top">
                    <span class="mdl-list__item-primary-content">
                        <span class="mdl-list__item-avatar background-color--primary">
                            <i class="material-icons">plus_one</i>
                        </span>
                        <span>You have 3 new orders.</span>
                    </span>
                    <span class="mdl-list__item-secondary-content">
                      <span class="label">just now</span>
                    </span>
                </li>
                <li class="mdl-menu__item mdl-list__item list__item--border-top">
                    <span class="mdl-list__item-primary-content">
                        <span class="mdl-list__item-avatar background-color--secondary">
                            <i class="material-icons">error_outline</i>
                        </span>
                      <span>Database error</span>
                    </span>
                    <span class="mdl-list__item-secondary-content">
                      <span class="label">1 min</span>
                    </span>
                </li>
                <li class="mdl-menu__item mdl-list__item list__item--border-top">
                    <span class="mdl-list__item-primary-content">
                        <span class="mdl-list__item-avatar background-color--primary">
                            <i class="material-icons">new_releases</i>
                        </span>
                      <span>The Death Star is built!</span>
                    </span>
                    <span class="mdl-list__item-secondary-content">
                      <span class="label">2 hours</span>
                    </span>
                </li>
                <li class="mdl-menu__item mdl-list__item list__item--border-top">
                    <span class="mdl-list__item-primary-content">
                        <span class="mdl-list__item-avatar background-color--primary">
                            <i class="material-icons">mail_outline</i>
                        </span>
                      <span>You have 4 new mails.</span>
                    </span>
                    <span class="mdl-list__item-secondary-content">
                      <span class="label">5 days</span>
                    </span>
                </li>
                <li class="mdl-list__item list__item--border-top">
                    <button href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">ALL NOTIFICATIONS</button>
                </li>
            </ul>

            <div class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon message" id="inbox" data-badge="4">
                mail_outline
            </div>
            <!-- Messages dropdown-->
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right mdl-shadow--2dp messages-dropdown"
                for="inbox">
                <li class="mdl-list__item">
                    You have 4 new messages!
                </li>
                <li class="mdl-menu__item mdl-list__item mdl-list__item--two-line list__item--border-top">
                    <span class="mdl-list__item-primary-content">
                        <span class="mdl-list__item-avatar background-color--primary">
                            <text>A</text>
                        </span>
                        <span>Alice</span>
                        <span class="mdl-list__item-sub-title">Birthday Party</span>
                    </span>
                    <span class="mdl-list__item-secondary-content">
                      <span class="label label--transparent">just now</span>
                    </span>
                </li>
                <li class="mdl-menu__item mdl-list__item mdl-list__item--two-line list__item--border-top">
                    <span class="mdl-list__item-primary-content">
                        <span class="mdl-list__item-avatar background-color--baby-blue">
                            <text>M</text>
                        </span>
                        <span>Mike</span>
                        <span class="mdl-list__item-sub-title">No theme</span>
                    </span>
                    <span class="mdl-list__item-secondary-content">
                      <span class="label label--transparent">5 min</span>
                    </span>
                </li>
                <li class="mdl-menu__item mdl-list__item mdl-list__item--two-line list__item--border-top">
                    <span class="mdl-list__item-primary-content">
                        <span class="mdl-list__item-avatar background-color--cerulean">
                            <text>D</text>
                        </span>
                        <span>Darth</span>
                        <span class="mdl-list__item-sub-title">Suggestion</span>
                    </span>
                    <span class="mdl-list__item-secondary-content">
                      <span class="label label--transparent">23 hours</span>
                    </span>
                </li>
                <li class="mdl-menu__item mdl-list__item mdl-list__item--two-line list__item--border-top">
                    <span class="mdl-list__item-primary-content">
                        <span class="mdl-list__item-avatar background-color--mint">
                            <text>D</text>
                        </span>
                        <span>Don McDuket</span>
                        <span class="mdl-list__item-sub-title">NEWS</span>
                    </span>
                    <span class="mdl-list__item-secondary-content">
                      <span class="label label--transparent">30 Nov</span>
                    </span>
                </li>
                <li class="mdl-list__item list__item--border-top">
                    <button href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">SHOW ALL MESSAGES</button>
                </li>
            </ul>

            <div class="avatar-dropdown" id="icon">
                <span><?php echo $personal_data[0]['first_name']." ".$personal_data[0]['second_name']." ".$personal_data[0]['surname']." ".$personal_data[0]['second_surname'] ?></span>
            </div>
            <!-- Account dropdawn-->
            <ul class="mdl-menu mdl-list mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-shadow--2dp account-dropdown" for="icon">
                <li class="mdl-list__item mdl-list__item--two-line">
                    <span class="mdl-list__item-primary-content">
                        <span><?php echo $personal_data[0]['first_name']." ".$personal_data[0]['second_name']." ".$personal_data[0]['surname']." ".$personal_data[0]['second_surname'] ?></span>
                        <span class="mdl-list__item-sub-title"><?php echo $personal_data[0]['email'] ?></span>
                    </span>
                </li>
                <li class="list__item--border-top"></li>
                <li class="mdl-menu__item mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                        <i class="material-icons mdl-list__item-icon">account_circle</i>
                        Datos personales
                    </span>
                </li>
                <?php if($rols['Auditor de campo'] || $rols['Auditor General']){ ?>
                    <li class="mdl-menu__item mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon">check_box</i>
                            Modulos Asignados
                        </span>
                        <span class="mdl-list__item-secondary-content">
                          <span class="label background-color--primary">3 new</span>
                        </span>
                    </li>
                <?php } ?>
                <?php if($rols['Sub Auditor'] || $rols['Auditor General']){ ?>    
                    <li class="mdl-menu__item mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon">check_box</i>
                            Proyectos Asignados
                        </span>
                        <span class="mdl-list__item-secondary-content">
                          <span class="label background-color--primary">3 new</span>
                        </span>
                    </li>
                <?php } ?>
                <!--<li class="list__item--border-top"></li>
                <li class="mdl-menu__item mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                        <i class="material-icons mdl-list__item-icon">settings</i>
                        Settings
                    </span>
                </li>-->
                <li class="mdl-menu__item mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                        <i class="material-icons mdl-list__item-icon text-color--secondary">exit_to_app</i>
                        <a href="<?php echo base_url(); ?>index.php/logout" class="nounderline">Cerrar sesión</a>
                    </span>
                </li>
            </ul>
            <!--<button id="more"
                    class="mdl-button mdl-js-button mdl-button--icon">
                <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-shadow--2dp settings-dropdown" for="more">
                <a class="mdl-menu__item" href="#">
                    Soporte.
                </a>
            </ul>-->
        </div>
    </header>

    <div class="mdl-layout__drawer">
        <header style="color:#dfb81c;">SISGEPRO</header>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link nounderline" href="<?php echo base_url(); ?>index.php/welcome">
                <i class="material-icons" role="presentation">home</i>
                Inicio
            </a>
            <?php if($permissions['Soporte']){ ?>
                <div class="sub-navigation">
                    <a href="#" class="mdl-navigation__link nounderline">
                        <i class="material-icons">person_add</i>
                        Usuarios
                        <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                    <div class="mdl-navigation">
                        <a class="mdl-navigation__link nounderline" href="<?php echo base_url(); ?>index.php/user/listado">
                            <i class="material-icons">hdr_weak</i>
                            <span style="text-align: right;">Listado</span>
                            <i class="material-icons"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
            <?php if($permissions['Soporte'] || $permissions['Proyectos']){ ?>
                <div class="sub-navigation">
                    <a href="#" class="mdl-navigation__link nounderline">
                        <i class="material-icons">dns</i>
                        Proyectos
                        <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                    <?php if($permissions['Soporte']){ ?>
                        <div class="mdl-navigation">
                            <a class="mdl-navigation__link nounderline" href="<?php echo base_url(); ?>index.php/user/listado">
                                <i class="material-icons">hdr_weak</i>
                                Asignar
                                <i class="material-icons"></i>
                            </a>
                        </div>
                        <div class="mdl-navigation">
                            <a class="mdl-navigation__link nounderline" href="<?php echo base_url(); ?>index.php/user/listado">
                                <i class="material-icons">hdr_weak</i>
                                Sin asignar
                                <i class="material-icons"></i>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="mdl-navigation">
                        <a class="mdl-navigation__link nounderline" href="<?php echo base_url(); ?>index.php/user/listado">
                            <i class="material-icons">hdr_weak</i>
                            Asignados
                            <i class="material-icons"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
            <?php if($permissions['Soporte'] || $permissions['Proyectos'] || $permissions['Modulos']){ ?>
                <div class="sub-navigation">
                    <a href="#" class="mdl-navigation__link nounderline">
                        <i class="material-icons">assignment</i>
                        Modulos
                        <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                    <?php if($permissions['Soporte'] || $permissions['Proyectos']){ ?>
                        <div class="mdl-navigation">
                            <a class="mdl-navigation__link nounderline" href="<?php echo base_url(); ?>index.php/user/listado">
                                <i class="material-icons">hdr_weak</i>
                                Asignar
                                <i class="material-icons"></i>
                            </a>
                        </div>
                        <div class="mdl-navigation">
                            <a class="mdl-navigation__link nounderline" href="<?php echo base_url(); ?>index.php/user/listado">
                                <i class="material-icons">hdr_weak</i>
                                Sin asignar
                                <i class="material-icons"></i>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="mdl-navigation">
                        <a class="mdl-navigation__link nounderline" href="<?php echo base_url(); ?>index.php/user/listado">
                            <i class="material-icons">hdr_weak</i>
                            Asignados
                            <i class="material-icons"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </nav>
    </div>
    <main class="mdl-layout__content">
