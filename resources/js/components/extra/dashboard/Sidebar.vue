<template>
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
            <ul class="nav flex-column">
                        <div class="dropdown-divider"></div>
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="icon icon-ico-inicio"> </i>
                                Inicio
                            </a>
                        </li>

                        <li class="nav-item">
                            <router-link to="/pbx" class="nav-link">
                                <i class="icon icon-pbxvirtual"> </i>
                                PBX Virtual
                            </router-link>

                        </li>
                        <li class="nav-item">

                             <router-link to="/numeros-virtuales" class="nav-link">
                                <i class="icon icon-pbxvirtual"> </i>
                                Números Virtuales
                            </router-link>

                        </li>
                        <li class="nav-item">
                            <router-link to="/linea-018000" class="nav-link">
                                <i class="icon icon-pbxvirtual"> </i>
                                Líneas 018000
                            </router-link>
                        </li>
                        <li class="nav-item">
                             <router-link to="/llamadas-internet" class="nav-link">
                                <i class="icon icon-pbxvirtual"> </i>
                                Líneas por Internet
                            </router-link>

                        </li>
                        <li class="nav-item">
                            <router-link to="/mensajes-texto" class="nav-link">
                                <i class="icon icon-pbxvirtual"> </i>
                                Mensajes de Texto
                            </router-link>

                        </li>
                        <li class="nav-item">
                            <router-link to="/mensajes-texto-voz" class="nav-link">
                                <i class="icon icon-pbxvirtual"> </i>
                                Mensajes de Texto a Voz
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/mensajes-voz" class="nav-link">
                                <i class="icon icon-pbxvirtual"> </i>
                                Mensajes de Voz
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/mensajes-api" class="nav-link">
                                <i class="icon icon-pbxvirtual"> </i>
                                Mensajes por API
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/validacion-numeros" class="nav-link">
                                <i class="icon icon-pbxvirtual"> </i>
                                Validación de Numeros
                            </router-link>
                        </li>
                        <li class="nav-item">
                             <router-link to="/reportes" class="nav-link">
                                <i class="icon icon-pbxvirtual"> </i>
                                Reportes
                            </router-link>
                        </li>
                        <li class="nav-item">
                             <router-link to="/pagos-recargas" class="nav-link">
                                <i class="icon icon-pbxvirtual"> </i>
                                Reportes
                            </router-link>
                        </li>
                    </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <router-view></router-view>
        </main>
    </div>
</template>
