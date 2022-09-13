
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <style>
            @font-face {
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 300;
                src: local('Roboto Light'), local('Roboto-Light'), url(https://fonts.gstatic.com/s/roboto/v20/KFOlCnqEu92Fr1MmSU5vAw.ttf) format('truetype');
            }
            @font-face {
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                src: local('Roboto'), local('Roboto-Regular'), url(https://fonts.gstatic.com/s/roboto/v20/KFOmCnqEu92Fr1Me5Q.ttf) format('truetype');
            }
            @font-face {
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                src: local('Roboto Bold'), local('Roboto-Bold'), url(https://fonts.gstatic.com/s/roboto/v20/KFOlCnqEu92Fr1MmWUlvAw.ttf) format('truetype');
            }
            
            /* Añado la declaración de font-family, para usar la fuente de Google Fonts en este PDF */
            
            body {
                font-family: 'Roboto', serif;
            }
            h1{
            text-align: center;
            text-transform: uppercase;
            }
            .contenido{
            font-size: 20px;
            }
            #primero{
            background-color: #ccc;
            }
            #segundo{
            color:#44a359;
            }
            #tercero{
            text-decoration:line-through;
            }
            .text-center{
                text-align: center;
            }
            .font-bold{
                font-weight: 700;
            }

            .font-semibold{
                font-weight: 400;
            }

            .uppercase{
                text-transform: uppercase;
            }

            .text-xs {
                font-size: 0.50rem;
                line-height: 1;
            }

            .text-sm {
                font-size: 0.85rem;
                line-height: 1;
            }

            .text-base {
                font-size: 1rem;
                line-height: 1;
            }

            .text-lg {
                font-size: 1.125rem;
                line-height: 1;
            }

            .text-xl {
                font-size: 1.25rem;
                line-height: 1;
            }
            p{
                margin: 0px;
            }

            .bg-gray-200 {
                --tw-bg-opacity: 1;
                background-color: #e5e7eb;
            }

            .text-white {
                color: #fff;
            }

            .px-5{
                padding-top: 5px;
                padding-bottom: 5px;
            }

            .w-50{
                width: 50%;
                min-width: 50%;
                max-width: 50%;
            }
            .w-45{
                width: 43%;
                min-width: 43%;
                max-width: 43%;
            }
            .w-5{
                width: 7%;
                min-width: 7%;
                max-width: 7%;
            }
            .w-100{
                width: 100%;
            }

            .flex{
                display: flexbox;
            }

            .grid-cols-9 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .gap-4 {
                gap: 1rem;
            }

            .ml-5{
                margin-left: 1rem;
            }
            table, tbody, tr, td{
                border: solid 1px #6b7280;
                border-collapse: collapse;
            }

            td{
                padding-left: 5px;
                padding-right: 5px;
                font-family: 'Roboto', serif;
            }

            .border-gray{
                border-bottom: solid 2px #6b7280;
            }

            td img{
                width: 25px;
                height: 25px;
                margin-top: 10px;
                margin-bottom: 10px;
                margin-left: 7px;
            }

            td p{
                text-align: justify;
                line-height: 1!important;
                font-family: 'Roboto', serif;
            }
            .lh-1{
                line-height: 1;
            }

            .gray-bajo{
                background-color: #F3F4F6;
            }
        
        
    </style>
    </head>
    <body>
        <p class="text-center font-bold uppercase text-xl">Documentos que integran el expediente técnico de obra</p>
        <hr>
        <p class="font-bold uppercase text-center bg-gray-200 px-5 border-gray">
            Datos generales de la obra
        </p>
        <div>
            <table class="w-100">
                <tr >
                    <td class="w-100" colspan="2">
                        <p class="font-semibold text-xs uppercase">Nombre de la obra</p>
                        <p class="ml-5 text-sm uppercase">{{ $obj_obra->get('obra')->nombre_obra }}</p>
                    </td>
                </tr>
                <tr >
                    <td class="w-50">
                        <p class="font-semibold text-xs uppercase">Localidad </p>
                        <p class="ml-5 text-sm uppercase">{{ $obj_obra->get('obra')->nombre_localidad }}</p>
                    </td>
                    <td class="w-50">
                        <p class="font-semibold text-xs uppercase">Modalidad de ejecución</p>
                        <p class="ml-5 text-sm uppercase">
                            @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                                Contrato -
                                @switch($obj_obra->get('contrato')->modalidad_asignacion)
                                    @case(3)
                                        Adjudicación directa
                                    @break
                                    @case(2)
                                        Invitación a cuando menos tres contratistas
                                    @break
                                    @default
                                        Licitación pública
                                @endswitch
                            @else
                                Administración directa
                            @endif
                        </p>
                        
                    </td>
                </tr>
              
                <tr>
                    <td class="w-50">
                        <p class="font-semibold text-xs uppercase">Municipio </p>
                        <p class="ml-5 text-sm uppercase">{{ $obj_obra->get('obra')->nombre_municipio }}</p>
                    </td>
                    <td class="w-50">
                        <p class="font-semibold text-xs uppercase">Fuente de financiamiento</p>
                        @foreach ($fuentes_financiamiento as $fuente)
                            <p class="ml-5 text-sm uppercase">{{ $fuente->nombre_corto }} - {{$fuente->monto}}</p>
                        @endforeach
                    </td>
                </tr>
              
                <tr>
                    <td class="w-50">
                        <p class="font-semibold text-xs uppercase">Distrito </p>
                        <p class="ml-5 text-sm uppercase">{{ $obj_obra->get('obra')->nombre_distrito }}</p>
                    </td>
                    <td class="w-50">
                        <p class="font-semibold text-xs uppercase">Oficio de notificación </p>
                        <p class="ml-5 text-sm uppercase">{{ $obj_obra->get('obra')->oficio_notificacion }}</p>
                        
                    </td>
                </tr>
              
                <tr>
                    <td class="w-50">
                        
                        <p class="font-semibold text-xs uppercase">Monto de la obra</p>
                        <p class="ml-5 text-sm uppercase">
                            @if($obj_obra->get('obra')->monto_modificado != null)
                                {{ $obj_obra->get('obra')->monto_modificado }}
                            @else
                                {{ $obj_obra->get('obra')->monto_contratado }}
                            @endif
                        </p>
                    </td>
                    <td class="w-50">
                        <p class="font-semibold text-xs uppercase">Periodo de ejecución</p>
                        <p class="ml-5 text-sm uppercase">Fecha de inicio: {{ date('d-m-Y', strtotime($obj_obra->get('obra')->fecha_inicio_programada)) }}</p>
                        <p class="ml-5 text-sm uppercase">Fecha de termino: {{ date('d-m-Y', strtotime($obj_obra->get('obra')->fecha_final_programada)) }}</p>
                        
                        
                    </td>
                </tr>
                @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                    <tr>
                        <td class="w-50">
                            <p class="font-semibold text-xs">No DE CONTRATO </p>
                            <p class="ml-5 text-sm uppercase">{{ $obj_obra->get('contrato')->numero_contrato }}</p>
                        </td>
                        <td class="w-50">
                            <p class="font-semibold text-xs uppercase">Fecha del contrato </p>
                            <p class="ml-5 text-sm uppercase">{{ date('d-m-Y', strtotime($obj_obra->get('contrato')->fecha_contrato)) }}</p>
                        </td>
                    </tr>
                @endif
                @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                    <tr>
                        <td class="w-50"  colspan="2">
                            <p class="font-semibold text-xs uppercase">Contratista</p>
                            <p class="ml-5 text-sm uppercase">{{ $obj_obra->get('contrato')->razon_social }}</p>
                        </td>
                    </tr>
                @endif
              
            </table>
        </div>
        
        <div >
            <div>
                <p class="font-bold text-
                e text-center uppercase" style="margin-top: 20px; margin-bottom: 20px;">Integración del expediente técnico</p>

                <p class="font-bold text-sm uppercase text-center bg-gray-200 px-5 border-gray lh-1">
                    PARTE SOCIAL
                </p>
                <table class="w-100">
                    <tr >
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Acta de integración del Consejo de Desarrollo Municipal
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->acta_integracion_consejo)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Acta de selección de obras
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->acta_seleccion_obras)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>
                    <tr >
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Acta de priorización de obras, acciones sociales básicas e inversión
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->acta_priorizacion_obras)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Acta de integración del comité de obras
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->acta_integracion_comite)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>
                  
                    <tr>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Convenio de concertación
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->convenio_concertacion)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                {{$obj_obra->get('obra')->modalidad_ejecucion == 2?'Acta de excepción a la licitación pública': 'Acta de acuerdo de cabildo para ejecutar la obra por Administracion Directa'}}
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->acta_excep_licitacion)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>
                  
                    <tr>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Convenio celebrado con instancias Estatales y Federales para Mezcla de recursos, transferencias de recursos
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->convenio_mezcla)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Acta de aprobacion y autorizacion de obras, acciones sociales e inversiones
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->acta_aprobacion_obra)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>

                    @if($obj_obra->get('obra')->modalidad_ejecucion == 2 && $obj_obra->get('contrato')->modalidad_asignacion == 3)
                        <tr>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Acta para adjudicar la obra de manera directa
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('social')->acta_ejecutar_adjudicacion)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            
                            <td class="w-45" style="border-right: none;"></td>
                            <td class="w-5" style="border-left: none;">
                                
                            </td>
                        </tr>
                    @endif
                  
                    
                  
                </table>
                
                <p class="font-bold text-base text-center uppercase" style="margin-top: 10px;">PARTE TÉCNICA</p>

                <p class="text-sm font-bold uppercase text-center bg-gray-200 px-5 border-gray lh-1" style="margin-top: 10px;">
                    PROYECTO EJECUTIVO
                </p>
                <table class="w-100">
                    <tr >
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Estudio de factibilidad técnica, económica y ecológica de la realización de la obra
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->estudio_factibilidad)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Oficio de notificación de aprobación y autorización de obras, acciones sociales básicas e inversiones
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->oficio_aprobacion_obra)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>
                    <tr >
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Anexos del oficio de notificación, de aprobación y autorización de obras, acciones sociales básicas e inversiones
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->anexos_oficio_notificacion)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Cédula de información básica
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->cedula_informacion_basica)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>
                  
                    <tr>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Generalidades de la inversión
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->generalidades_inversion)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Documentos que acrediten la tenencia de la tierra
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->tenencia_tierra)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>
                  
                    <tr>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Dictamen de impacto ambiental
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->dictamen_impacto_ambiental)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Presupuesto de obra programada
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->presupuesto_obra)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>

                    <tr>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Explosión de insumos programada
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->explosion_insumos)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Generadores de obra programada
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->generadores_obra)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>

                    <tr>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Planos del proyecto
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->planos_proyecto)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Especificaciones generales y particulares de construcción
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->especificaciones_generales_particulares)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>

                    <tr>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Licencia del Director Responsable de Obra
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->dro)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Programa de obra e inversión
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->programa_obra_inversion)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>

                    <tr>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Croquis de micro localización
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->croquis_macro)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                        <td class="w-45" style="border-right: none;">
                            <p class="text-sm">
                                Croquis de macro localización
                            </p>
                        </td>
                        <td class="w-5" style="border-left: none;">
                            @switch($obj_obra->get('social')->croquis_micro)
                                @case(1)
                                    <img src="./image/Bien.jpg">
                                @break
                                @case(3)
                                    <img src="./image/NA.jpg">
                                @break
                                    @default
                                <img src="./image/Mal.jpg">
                            @endswitch
                        </td>
                    </tr>
                </table>
                
                @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                    <p class="text-sm font-bold uppercase text-center bg-gray-200 px-5 border-gray lh-1" style="margin-top: 20px;">
                        PROCESO DE CONTRATACIÓN
                    </p>
                    <table class="w-100">
                        
                            <tr >
                                <td class="w-45" style="border-right: none;">
                                    <p class="text-sm">
                                        Inscripción al padrón de contratista
                                    </p>
                                </td>
                                <td class="w-5" style="border-left: none;">
                                    @switch($obj_obra->get('contrato')->padron_contratistas)
                                        @case(1)
                                            <img src="./image/Bien.jpg">
                                        @break
                                        @case(3)
                                            <img src="./image/NA.jpg">
                                        @break
                                            @default
                                        <img src="./image/Mal.jpg">
                                    @endswitch
                                </td>
                                <td class="w-45" style="border-right: none;">
                                    <p class="text-sm">
                                        Invitaciones (con acuses de recepción)
                                    </p>
                                </td>
                                <td class="w-5" style="border-left: none;">
                                    @switch($obj_obra->get('contrato')->invitacion_acuse_recepcion)
                                        @case(1)
                                            <img src="./image/Bien.jpg">
                                        @break
                                        @case(3)
                                            <img src="./image/NA.jpg">
                                        @break
                                            @default
                                        <img src="./image/Mal.jpg">
                                    @endswitch
                                </td>
                            </tr>

                            <tr >
                                <td class="w-45" style="border-right: none;">
                                    <p class="text-sm">
                                        Oficio de aceptación de la invitación (con acuses de recepción)
                                    </p>
                                </td>
                                <td class="w-5" style="border-left: none;">
                                    @switch($obj_obra->get('contrato')->aceptacion_invitacion)
                                        @case(1)
                                            <img src="./image/Bien.jpg">
                                        @break
                                        @case(3)
                                            <img src="./image/NA.jpg">
                                        @break
                                            @default
                                        <img src="./image/Mal.jpg">
                                    @endswitch
                                </td>
                                @if ($obj_obra->get('contrato')->modalidad_asignacion != 3)
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Bases de licitacion (con anexos)
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($obj_obra->get('licitacion')->bases_licitacion)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                @else
                                    <td class="w-45" style="border-right: none;">
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                    </td>
                                @endif
                            </tr>
                            @if ($obj_obra->get('contrato')->modalidad_asignacion != 3)
                                <tr>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Constancia de visita o de conocer el sitio donde se ejecutará la obra
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($obj_obra->get('licitacion')->constancia_visita)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Acta de la junta de aclaraciones
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($obj_obra->get('licitacion')->acta_junta_aclaraciones)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                </tr>
                        
                                <tr>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Acta de apertura técnica
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($obj_obra->get('licitacion')->acta_apertura_tecnica)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Dictamen técnico y análisis detallado
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($obj_obra->get('licitacion')->dictamen_tecnico)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                </tr>

                                <tr>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Acta de apertura económica
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($obj_obra->get('licitacion')->acta_apertura_economica)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Dictamen económico y análisis detallado
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($obj_obra->get('licitacion')->dictamen_economico)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                </tr>

                                <tr>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Dictamen
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($obj_obra->get('licitacion')->dictamen)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Acta de fallo
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($obj_obra->get('licitacion')->acta_fallo)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                </tr>

                                <tr>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Propuesta económica de los licitantes
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($obj_obra->get('licitacion')->propuesta_licitantes_economica)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Propuesta técnica de los licitantes
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($obj_obra->get('licitacion')->propuesta_licitantes_tecnica)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                </tr>
                            @endif
                        <tr>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Contrato
                                    @if ($obj_obra->get('contrato')->contrato_tipo == 1) <span class="font-bold">(Precios unitarios)</span> @endif
                                    @if ($obj_obra->get('contrato')->contrato_tipo == 2) (Precios Alzados) @endif
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->contrato)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Oficio justificatorio para convenio modificatorio
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->oficio_justificativo_convenio_modificatorio)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                        </tr>
                        @if($convenios->first() != null)
                            <tr>
                                <td class="w-45" style="border-right: none;" colspan="4">
                                    <p class="text-sm px-5 font-bold text-center uppercase">
                                        Convenios modificatorios
                                    </p>
                                </td>  
                            </tr>
                            @foreach ($convenios as $key => $convenio)
                                @if($key%2==0)
                                    <tr>
                                        <td class="w-45" style="border-right: none;">
                                            <p class="text-sm">
                                                Convenio modificatorio
                                                @switch($convenio->tipo)
                                                    @case(1)
                                                        al monto del contrato
                                                    @break
                                                    @case(2)
                                                        al plazo del contrato
                                                    @break
                                                    @default
                                                        al monto y plazo del contrato
                                                @endswitch
                                            </p>
                                        </td>
                                        <td class="w-5" style="border-left: none;">
                                            @switch($convenio->agregado_expediente)
                                                @case(1)
                                                    <img src="./image/Bien.jpg">
                                                @break
                                                @case(3)
                                                    <img src="./image/NA.jpg">
                                                @break
                                                    @default
                                                <img src="./image/Mal.jpg">
                                            @endswitch
                                        </td>
                                        @if($key + 1 < sizeof($convenios))
                                            <td class="w-45" style="border-right: none;">
                                                <p class="text-sm">
                                                    Convenio modificatorio
                                                    @switch($convenios->get($key+1)->tipo)
                                                        @case(1)
                                                            al monto del contrato
                                                        @break
                                                        @case(2)
                                                            al plazo del contrato
                                                        @break
                                                        @default
                                                            al monto y plazo del contrato
                                                    @endswitch
                                                </p>
                                            </td>
                                            <td class="w-5" style="border-left: none;">
                                                @switch($convenios->get($key+1)->agregado_expediente)
                                                    @case(1)
                                                        <img src="./image/Bien.jpg">
                                                    @break
                                                    @case(3)
                                                        <img src="./image/NA.jpg">
                                                    @break
                                                        @default
                                                    <img src="./image/Mal.jpg">
                                                @endswitch
                                            </td>
                                        @else
                                            <td class="w-45" style="border-right: none;">
                                            </td>
                                            <td class="w-5" style="border-left: none;">
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        <tr >
                            <td class="w-45" style="border-right: none;" colspan="4">
                                <p class="text-sm px-5 font-bold text-center uppercase">
                                    Anexos del contrato
                                </p>
                            </td>  
                        </tr>

                        <tr >
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Catálogo de conceptos
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->catalogo_conceptos)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Análisis de precios unitarios
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->analisis_p_u)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                        </tr>

                        <tr >
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Calendario de la ejecución de los trabajos
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->montos_mensuales_ejecutados)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                            </td>
                            <td class="w-5" style="border-left: none;">
                            </td>
                        </tr>
                        
                    </table>
                @endif

                <p class="text-sm font-bold uppercase text-center bg-gray-200 px-5 border-gray lh-1" style="margin-top: 20px;">
                    DOCUMENTACIÓN COMPROBATORIA
                </p>

                <table class="w-100">
                    @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                        <tr >
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Asignacion mediante oficio del Superintendente de obra
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->oficio_superintendente)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Asignacion mediante oficio del residente de obra
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->oficio_residente_obra)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                        </tr>

                        <tr >
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Oficio emitido por la ejecutora dirigido al contratista por la disposición del inmueble
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->oficio_disposicion_inmueble)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Notificacion de inicio de obra
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->oficio_inicio_obra)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>  
                            
                        </tr>

                        <tr >
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Factura de anticipo: <span class="font-bold">{{ $obj_obra->get('contrato')->factura_anticipo }}</span>
                                    <br>
                                    Importe: <span class="font-bold">{{ $total_anticipo }}</span>
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->exp_factura_anticipo)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                            </td>
                            <td class="w-5" style="border-left: none;">
                            </td>
                        </tr>

                        @if($estimaciones->first() != null)
                            <tr>
                                <td class="w-45 gray-bajo" style="border-right: none;" colspan="4">
                                    <p class="text-sm px-5 font-bold text-center uppercase">
                                        Desglose de Estimaciones
                                    </p>
                                </td>
                            </tr>
                            @foreach ($estimaciones as $key => $estimacion)
                                <tr>
                                    <td class="w-45" style="border-right: none;" colspan="4">
                                        <p class="text-sm px-5 font-bold text-center">
                                            {{ $estimacion->nombre }}
                                            @if ($estimacion->finiquito == 1)
                                                y finiquito
                                            @endif
                                        </p>
                                    </td>
                                </tr>

                                <tr >
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Factura de la estimación
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($estimacion->factura_estimacion)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Presupuesto de la estimación
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($estimacion->presupuesto_estimacion)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>  
                                    
                                </tr>

                                <tr >
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Carátula de estimación
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($estimacion->caratula_estimacion)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Cuerpo de estimación
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($estimacion->cuerpo_estimacion)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>  
                                    
                                </tr>

                                <tr >
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Resumen de estimación
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($estimacion->resumen_estimacion)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Estado de cuenta de estimación
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($estimacion->estado_cuenta_estimacion)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>  
                                    
                                </tr>

                                <tr >
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Número generadores de estimación
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($estimacion->numero_generadores_estimacion)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Corquis de localización de estimación
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($estimacion->croquis_ilustrativo_estimacion)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>  
                                    
                                </tr>

                                <tr >
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Soporte fotográfico de estimación
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($estimacion->reporte_fotografico_estimacion)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>
                                    <td class="w-45" style="border-right: none;">
                                        <p class="text-sm">
                                            Notas de bitácora
                                        </p>
                                    </td>
                                    <td class="w-5" style="border-left: none;">
                                        @switch($estimacion->notas_bitacora)
                                            @case(1)
                                                <img src="./image/Bien.jpg">
                                            @break
                                            @case(3)
                                                <img src="./image/NA.jpg">
                                            @break
                                                @default
                                            <img src="./image/Mal.jpg">
                                        @endswitch
                                    </td>  
                                    
                                </tr>
                            @endforeach  
                        @endif

                        <tr>
                            <td class="w-45 gray-bajo" style="border-right: none;" colspan="4">
                                <p class="text-sm px-5 font-bold text-center uppercase">
                                    Garantías
                                </p>
                            </td>
                        </tr>

                        <tr >
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Fianza de anticipo: <span class="font-bold">{{ $obj_obra->get('contrato')->fianza_anticipo }}</span>
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->exp_fianza_anticipo)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Fianza de cumplimiento: <span class="font-bold">{{ $obj_obra->get('contrato')->fianza_cumplimiento }}</span>
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->exp_fianza_cumplimiento)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>  
                            
                        </tr>

                        <tr >
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Fianza de vicios ocultos: <span class="font-bold">{{ $obj_obra->get('contrato')->fianza_v_o }}</span>
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->exp_fianza_v_o)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                            </td>
                            <td class="w-5" style="border-left: none;">
                            </td>  
                            
                        </tr>
                    @else
                        <tr >
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Inventario de la maquinaria y equipo de construcción con que cuenta el municipio
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('admin')->inventario_maquinaria_construccion)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Relacion de la plantilla del personal tecnico y administrativo relacionado con la obra
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('admin')->plantilla_personal)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            
                        </tr>

                        <tr >
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Identificacion oficial de los trabajadores que aparecen en las listas de raya
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('admin')->indentificacion_oficial_trabajadores)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Reporte fotográfico
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('admin')->reporte_fotografico)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            
                        </tr>

                        <tr >
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Notas de bitácora
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('admin')->notas_bitacora)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Acta de entrega recepción
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('admin')->acta_entrega_municipio)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                        </tr>

                        <tr >
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Cédula detallada de facturación total de la obra
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('admin')->cedula_detallada_facturacion)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                            </td>
                            <td class="w-5" style="border-left: none;">
                            </td>
                        </tr>

                        @if($listas_raya->first() != null)
                            <td class="w-45 gray-bajo" style="border-right: none;" colspan="4">
                                <p class="text-sm px-5 font-bold text-center uppercase">
                                    Listas de raya
                                </p>
                            </td>
                            @foreach ($listas_raya as $key => $lista)
                                @if($key%2==0)
                                    <tr>
                                        <td class="w-45" style="border-right: none;">
                                            <p class="text-sm">
                                                Lista de raya {{$lista->numero_lista_raya}}<br> Del {{date('d-m-Y', strtotime($lista->fecha_inicio))}} al {{date('d-m-Y', strtotime($lista->fecha_fin))}}
                                            </p>
                                        </td>
                                        <td class="w-5" style="border-left: none;">
                                            @switch($lista->agregado_expediente)
                                                @case(1)
                                                    <img src="./image/Bien.jpg">
                                                @break
                                                @case(3)
                                                    <img src="./image/NA.jpg">
                                                @break
                                                    @default
                                                <img src="./image/Mal.jpg">
                                            @endswitch
                                        </td>
                                        @if($key + 1 < sizeof($listas_raya))
                                            <td class="w-45" style="border-right: none;">
                                                <p class="text-sm">
                                                    Lista de raya {{$listas_raya->get($key+1)->numero_lista_raya}}
                                                    <br>
                                                     Del {{date('d-m-Y', strtotime($listas_raya->get($key+1)->fecha_inicio))}} 
                                                     al {{date('d-m-Y', strtotime($listas_raya->get($key+1)->fecha_fin))}}
                                                    
                                                </p>
                                            </td>
                                            <td class="w-5" style="border-left: none;">
                                                @switch($listas_raya->get($key+1)->agregado_expediente)
                                                    @case(1)
                                                        <img src="./image/Bien.jpg">
                                                    @break
                                                    @case(3)
                                                        <img src="./image/NA.jpg">
                                                    @break
                                                        @default
                                                    <img src="./image/Mal.jpg">
                                                @endswitch
                                            </td>
                                        @else
                                            <td class="w-45" style="border-right: none;">
                                            </td>
                                            <td class="w-5" style="border-left: none;">
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        @endif

                        @if($listas_raya->first() != null)
                            <td class="w-45 gray-bajo" style="border-right: none;" colspan="4">
                                <p class="text-sm px-5 font-bold text-center uppercase">
                                    Facturas
                                </p>
                            </td>
                            @foreach ($facturas as $key => $factura)
                                @if($key%2==0)
                                    <tr>
                                        <td class="w-45" style="border-right: none;">
                                            <p class="text-sm">
                                                Factura {{$factura->folio_fiscal}}
                                            </p>
                                        </td>
                                        <td class="w-5" style="border-left: none;">
                                            @switch($factura->agregado_expediente)
                                                @case(1)
                                                    <img src="./image/Bien.jpg">
                                                @break
                                                @case(3)
                                                    <img src="./image/NA.jpg">
                                                @break
                                                    @default
                                                <img src="./image/Mal.jpg">
                                            @endswitch
                                        </td>
                                        @if($key + 1 < sizeof($facturas))
                                            <td class="w-45" style="border-right: none;">
                                                <p class="text-sm">
                                                    Factura {{$facturas->get($key+1)->folio_fiscal}}
                                                </p>
                                            </td>
                                            <td class="w-5" style="border-left: none;">
                                                @switch($facturas->get($key+1)->agregado_expediente)
                                                    @case(1)
                                                        <img src="./image/Bien.jpg">
                                                    @break
                                                    @case(3)
                                                        <img src="./image/NA.jpg">
                                                    @break
                                                        @default
                                                    <img src="./image/Mal.jpg">
                                                @endswitch
                                            </td>
                                        @else
                                            <td class="w-45" style="border-right: none;">
                                            </td>
                                            <td class="w-5" style="border-left: none;">
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        @endif

                        @if($listas_raya->first() != null)
                            <td class="w-45 gray-bajo" style="border-right: none;" colspan="4">
                                <p class="text-sm px-5 font-bold text-center uppercase">
                                    Contratos de arrendamiento
                                </p>
                            </td>
                            @foreach ($contratos_arrendamiento as $key => $contrato)
                                @if($key%2==0)
                                    <tr>
                                        <td class="w-45" style="border-right: none;">
                                            <p class="text-sm">
                                                Contrato {{$contrato->numero_contrato}}
                                            </p>
                                        </td>
                                        <td class="w-5" style="border-left: none;">
                                            @switch($contrato->agregado_expediente)
                                                @case(1)
                                                    <img src="./image/Bien.jpg">
                                                @break
                                                @case(3)
                                                    <img src="./image/NA.jpg">
                                                @break
                                                    @default
                                                <img src="./image/Mal.jpg">
                                            @endswitch
                                        </td>
                                        @if($key + 1 < sizeof($contratos_arrendamiento))
                                            <td class="w-45" style="border-right: none;">
                                                <p class="text-sm">
                                                    Contrato {{$contratos_arrendamiento->get($key+1)->numero_contrato}}
                                                </p>
                                            </td>
                                            <td class="w-5" style="border-left: none;">
                                                @switch($contratos_arrendamiento->get($key+1)->agregado_expediente)
                                                    @case(1)
                                                        <img src="./image/Bien.jpg">
                                                    @break
                                                    @case(3)
                                                        <img src="./image/NA.jpg">
                                                    @break
                                                        @default
                                                    <img src="./image/Mal.jpg">
                                                @endswitch
                                            </td>
                                        @else
                                            <td class="w-45" style="border-right: none;">
                                            </td>
                                            <td class="w-5" style="border-left: none;">
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    @endif
                
                </table>

                @if ($obj_obra->get('obra')->modalidad_ejecucion == 2)
                    <p class="text-sm font-bold uppercase text-center bg-gray-200 px-5 border-gray lh-1" style="margin-top: 20px;">
                        Terminación de los trabajos
                    </p>
                    <table class="w-100">
                        
                            <tr >
                                <td class="w-45" style="border-right: none;">
                                    <p class="text-sm">
                                        Presupuesto definitivo
                                    </p>
                                </td>
                                <td class="w-5" style="border-left: none;">
                                    @switch($obj_obra->get('contrato')->presupuesto_definitivo)
                                        @case(1)
                                            <img src="./image/Bien.jpg">
                                        @break
                                        @case(3)
                                            <img src="./image/NA.jpg">
                                        @break
                                            @default
                                        <img src="./image/Mal.jpg">
                                    @endswitch
                                </td>
                                <td class="w-45" style="border-right: none;">
                                    <p class="text-sm">
                                        Actas de entrega de recepción fisica de los trabajos del contratista al municipio
                                    </p>
                                </td>
                                <td class="w-5" style="border-left: none;">
                                    @switch($obj_obra->get('contrato')->acta_entrega_contratista)
                                        @case(1)
                                            <img src="./image/Bien.jpg">
                                        @break
                                        @case(3)
                                            <img src="./image/NA.jpg">
                                        @break
                                            @default
                                        <img src="./image/Mal.jpg">
                                    @endswitch
                                </td>
                            </tr>

                            <tr >
                                <td class="w-45" style="border-right: none;">
                                    <p class="text-sm">
                                        Actas de entrega de recepción fisica de los trabajos del municipio a los beneficiarios
                                    </p>
                                </td>
                                <td class="w-5" style="border-left: none;">
                                    @switch($obj_obra->get('contrato')->acta_entrega_municipio)
                                        @case(1)
                                            <img src="./image/Bien.jpg">
                                        @break
                                        @case(3)
                                            <img src="./image/NA.jpg">
                                        @break
                                            @default
                                        <img src="./image/Mal.jpg">
                                    @endswitch
                                </td>
                                <td class="w-45" style="border-right: none;">
                                    <p class="text-sm">
                                        Acta de extinción de derechos y obligaciones
                                    </p>
                                </td>
                                <td class="w-5" style="border-left: none;">
                                    @switch($obj_obra->get('contrato')->acta_extincion)
                                        @case(1)
                                            <img src="./image/Bien.jpg">
                                        @break
                                        @case(3)
                                            <img src="./image/NA.jpg">
                                        @break
                                            @default
                                        <img src="./image/Mal.jpg">
                                    @endswitch
                                </td>
                            </tr>
                            
                        <tr>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Aviso de terminación de la obra por parte del contratista
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->aviso_terminacion_obra)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                            <td class="w-45" style="border-right: none;">
                                <p class="text-sm">
                                    Sabana de finiquito
                                </p>
                            </td>
                            <td class="w-5" style="border-left: none;">
                                @switch($obj_obra->get('contrato')->saba_finiquito)
                                    @case(1)
                                        <img src="./image/Bien.jpg">
                                    @break
                                    @case(3)
                                        <img src="./image/NA.jpg">
                                    @break
                                        @default
                                    <img src="./image/Mal.jpg">
                                @endswitch
                            </td>
                        </tr>
                    </table>
                @endif

                <p class="text-sm font-bold uppercase text-center bg-gray-200 px-5 border-gray lh-1" style="margin-top: 20px;">
                    Observaciones
                </p>
                <table class="w-100">
                        
                    <tr >
                        <td class="w-100 " style="border-right: none; padding-top: 10px; padding-bottom: 10px;">
                            @if($observaciones != null)          
                                @foreach ($observaciones->observacion as $key => $observacion)
                                    <p class="text-sm font-semibold border p-2">* {{$observacion}}</p>
                                @endforeach
                            @else
                                <p class="text-sm font-semibold border p-2">Sin observaciones</p>
                            @endif
                        </td>
                    </tr>
                </table>

                <table class="w-100" style="margin-top: 20px;">
                        
                    <tr >
                        <td class="w-50 " style="border-right: none; padding-top: 90px; padding-bottom: 10px;">
                            <hr>
                            <p class="text-sm font-bold uppercase text-center" style="">Entrega</p>
                        </td>
                        <td class="w-50 " style="border-right: none; padding-top: 90px; padding-bottom: 10px;">
                            <hr>
                            <p class="text-sm font-bold uppercase text-center">Recibe</p>
                        </td>
                    </tr>
                </table>
                     
        </div>
        <script>
            
        </script>
    </body>
</html>