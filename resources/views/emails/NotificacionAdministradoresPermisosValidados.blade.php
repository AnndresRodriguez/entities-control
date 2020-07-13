<body style="font-family: Helvetica,Arial,sans-serif; font-size: 14px; line-height: 1.42857143;">

    <div style="margin-left: 8.33333333%; width: 83.33333333%; float: left; position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px;">
        <div style="width: 33.33%; position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px; float: none; margin: 0 auto; text-align: center;">
            <img src="https://edtlsoft.com/developer/huem/logo-huem.png" alt="logo" style="padding: 50px;">
        </div>
    </div>

    <div style="margin-left: 8.33333333%; width: 83.33333333%; float: left; position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px;">
        
        <div style="margin-bottom: 20px; background-color: #ffffff; border: 1px solid transparent; border-radius: 4px; -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05); box-shadow: 0 1px 1px rgba(0,0,0,.05); border-color: #337ab7;">
        <!-- Default panel contents -->
            <div style="color: #333; background-color: #337ab7; font-weight: bold; border-color: #337ab7; padding: 10px 15px; border-bottom: 1px solid transparent; border-top-left-radius: 3px; border-top-right-radius: 3px;">
                Notificación de solicitud de asignación de pemisos validados
            </div>
            
            <div style="padding: 15px;">
                <p style="margin: 0 0 10px;">
                    Este correo se genera debido a que los permisos solicitado por el coloborador {{ $empleado }} ya fueron validados por su jefe inmediato y debe ser asigados en los respectivos softwares.
                </p>
            </div>

            <!-- List group -->
            <ul style="margin-bottom: 0; padding-left: 0; margin-top: 0; padding-right: 15px; padding-bottom: 15px;">
                <li style="border-width: 1px 0; border-radius: 0; position: relative; display: block; padding: 10px 15px; margin-bottom: -1px; background-color: #fff; border: 1px solid #ddd;"> 
                    <b style="font-weight: 700;">Colaborador:</b> {{ $empleado }} 
                </li>

                @foreach( $permisos as $permiso )
                    <li style="border-width: 1px 0; border-radius: 0; position: relative; display: block; padding: 10px 15px; margin-bottom: -1px; background-color: #fff; border: 1px solid #ddd; display: flex;"> 
                        <div style="width: 50%; text-align: left;">
                            <b style="font-weight: 700;">Permiso:</b> 
                            {{ $permiso['proceso']['ruta_permiso'] }}
                        </div>
                        <div style="width: 50%; text-align: right;">
                            <b style="font-weight: 700;">Fecha caducidad:</b>
                            {{ $permiso['fecha_vencimiento'] }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div style="margin-left:8.33333333%;width:83.33333333%;float:left;min-height:1px;padding-right:15px;padding-left:15px">
        <button style="display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;background-image:none;border:1px solid transparent;border-radius:4px;color:#fff;background-color:#337ab7;border-color:#2e6da4"> 
            <a href="{{ $ruta_btn }}" style="text-decoration:none;color:#ffffff" target="_blank">
                ASIGNAR PERMISOS
            </a> 
        </button>
    </div>

</body>