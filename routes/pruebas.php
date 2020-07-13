<?php

Route::get('/import_cie10', function(){

$data = DB::connection('sql_dg02')->table('GENDIAGNO')->select('DIACODIGO', 'DIANOMBRE')->get();

$total = 0;

foreach($data as $key => $value)
{
    $cie10 = App\Models\CodigoCie10::where('codigo', $value->DIACODIGO)->limit(1)->get();
    $cie10 = $cie10->get(0);

    if( !isset($cie10->id) )
    {
        $diacodigo = preg_replace('/X/i', '', $value->DIACODIGO);

        $cie10 = App\Models\CodigoCie10::where('codigo', $diacodigo)->limit(1)->get();
        $cie10 = $cie10->get(0);

        if( !isset($cie10->id) )
        {
            //$total++;
            //echo 'El codigo '. $value->DIACODIGO .' - '. trim($value->DIANOMBRE) .' no esta registrado en la base de datos.'. $diacodigo .' <br>';
            $diag = new App\Models\CodigoCie10();
            $diag->codigo      = $value->DIACODIGO;
            $diag->diagnostico = trim($value->DIANOMBRE);
            $diag->save();

            if( $diag->id )
            {
                $total++;
                echo 'El codigo '. $value->DIACODIGO .' - '. trim($value->DIANOMBRE) .' se registro en la base de datos.'. $diag->id .' <br>';
            }
        }
    }
    elseif( isset($cie10->id) && $cie10->diagnostico != trim($value->DIANOMBRE) ) 
    {
        //echo 'El codigo '. $value->DIACODIGO .' Tiene diferente descripcion. <br>';
        //echo $cie10->diagnostico .'<br>';
        //echo trim($value->DIANOMBRE) .'<br><br>';
    }

}

echo 'Total de registros realizados: '. $total .'';
});


Route::get('/import_codigos_soat', function(){

function getGrupoQx($descripcion)
{
    if( preg_match('/GQX\:\s?([0-9]{1,2})/', $descripcion, $gqx) ):
        return $gqx[1];
    else:
        return '';
    endif;
}

function getOnlyDescripcion($descripcion)
{
    return trim(preg_replace('/\-\s?GQX\:\s?([0-9]{1,2})/', '', $descripcion));
}
//echo getOnlyDescripcion('MASTOTOMIA INCLUYE DRENAJE DE LA MAMA - GQX: 03');

$data = DB::connection('sql_dg02')->table('GENSERIPS')->select('SIPCODIGO', 'SIPNOMBRE')->where('SIPTIPSER', 2)->get();

$total = 0;

foreach($data as $key => $value)
{
    $gqx     = getGrupoQx($value->SIPNOMBRE);
    $desc_dg = getOnlyDescripcion($value->SIPNOMBRE);

    $soat = App\Models\CodigoSoat::where('codigo', trim($value->SIPCODIGO))->limit(1)->get();
    $soat = $soat->get(0);

    if( !isset($soat->id) )
    {
        //$total++;
        //echo 'El codigo '. trim($value->SIPCODIGO) .' - '. $gqx .' no esta registrado en la base de datos. <br>';

        //$codigo_soat = new CodigoSoat();
        //$codigo_soat->codigo = '';

    }
    elseif( isset($soat->id) && trim($soat->grupo_qx) != $gqx ) 
    {
        $total++;
        echo 'El codigo en '. $value->SIPCODIGO .' Tiene diferente grupo en HuemApp. <br>';
        echo $gqx .'<br>';
        echo $soat->grupo_qx .'<br><br>';

        $soat->grupo_qx = $gqx;
        $soat->save();
    }
    elseif( isset($soat->descripcion) && trim($soat->descripcion) != trim($desc_dg) )
    {
        $total++;
        echo 'La descripcion en '. $value->SIPCODIGO .' Tiene diferente grupo en HuemApp. <br>';
        echo $desc_dg .'<br>';
        echo $soat->descripcion .'<br><br>';

        $soat->descripcion = trim($desc_dg);
        $soat->save();
    }
    else
    {
        $soat->grupo_qx     = trim($gqx);
        $soat->descripcion  = trim($desc_dg);
        $soat->save();
    }

}

echo 'Total de registros realizados: '. $total .'';
//return json_encode($data);
});

Route::get('/import_codigos_soat_db', function(){
$total = 0;
echo 'Runing <br>';
//$data = DB::connection('sql_dg02')->table('HCNSOLPQX')->select('HCNSOLPQX.GENSERIPS', 'SIPNOMBRE')->where('SIPTIPSER', 2)->get();

$data = DB::connection('sql_dg02')->
            select( 
                DB::raw('select h.GENSERIPS, COUNT(h.OID) AS total, g.SIPCODIGO, g.SIPNOMBRE  
                from HCNSOLPQX AS h
                INNER JOIN GENSERIPS AS g ON h.GENSERIPS=g.OID
                GROUP BY h.GENSERIPS, g.SIPCODIGO, g.SIPNOMBRE
                ORDER BY total DESC') 
            );

foreach( $data as $key => $value )
{
    $codigo_dg = preg_replace('/\./', '', $value->SIPCODIGO);

    $soat = App\Models\CodigoSoat::where('codigo', trim($codigo_dg))->limit(1)->get();
    $soat = $soat->get(0);

    if( !isset($soat->id) )
    {
         $total++;
         echo 'El codigo '. trim($value->SIPCODIGO) .' - no esta registrado en la base de datos. <br>';
         echo $value->SIPCODIGO .'<br>';
         //echo $soat->grupo_qx .'<br><br>';
    }
    else {
        echo '';
    }
}

//return count($data);
//return json_encode($data);
echo 'Total de registros realizados: '. $total .'';
});

Route::get('/import_codigos_soat_2', function(){

function getGrupoQx2($descripcion)
{
    if( preg_match('/GQX\:\s?([0-9]{1,2})/', $descripcion, $gqx) ):
        return $gqx[1];
    else:
        return '';
    endif;
}

function getOnlyDescripcion2($descripcion)
{
    return trim(preg_replace('/\-\s?GQX\:\s?([0-9]{1,2})/', '', $descripcion));
}
//echo getOnlyDescripcion('MASTOTOMIA INCLUYE DRENAJE DE LA MAMA - GQX: 03');

$data = DB::connection('sql_dg02')->table('GENSERIPS')->select('SIPCODIGO', 'SIPNOMBRE')->where('SIPTIPSER', 2)->get();

$total = 0;

foreach($data as $key => $value)
{
    $gqx     = getGrupoQx($value->SIPNOMBRE);
    $desc_dg = getOnlyDescripcion($value->SIPNOMBRE);

    $soat = App\Models\CodigoSoat::where('codigo', trim($value->SIPCODIGO))->limit(1)->get();
    $soat = $soat->get(0);

    if( !isset($soat->id) )
    {
        // $total++;
        // echo 'El codigo '. trim($value->SIPCODIGO) .' - '. $gqx .' no esta registrado en la base de datos. <br>';

        //$codigo_soat = new CodigoSoat();
        //$codigo_soat->codigo = '';

    }
    elseif( isset($soat->id) && trim($soat->grupo_qx) != $gqx ) 
    {
        $total++;
        echo 'El codigo en '. $value->SIPCODIGO .' Tiene diferente grupo en HuemApp. <br>';
        echo $gqx .'<br>';
        echo $soat->grupo_qx .'<br><br>';

        $soat->grupo_qx = $gqx;
        $soat->save();
    }
    elseif( isset($soat->descripcion) && trim($soat->descripcion) != trim($desc_dg) )
    {
        $total++;
        echo 'La descripcion en '. $value->SIPCODIGO .' Tiene diferente grupo en HuemApp. <br>';
        echo $desc_dg .'<br>';
        echo $soat->descripcion .'<br><br>';

        $soat->descripcion = $desc_dg;
        $soat->save();
    }
    else
    {
        //$soat->estado = 1;
        //$soat->save();
    }

}

echo 'Total de registros realizados: '. $total .'';
//return json_encode($data);
});