 <?php
  require_once("util.php");
  
  date_default_timezone_set('America/Mexico_City');
  $horaFechaReporteinicio = date("Y-m-d ");
  $horaFechaReportefin = date("Y-m-d ");
  $hora=7;
  $valoresY=array();
  $valoresX=array();
  for($i=0;$i<14;$i++){
      if($hora<10){
          $horaFechaReporteinicio.="0"."$hora".":00:00";
          $horaFechaReportefin.="0"."$hora".":59:59";
      }else{
          $horaFechaReporteinicio.="$hora".":00:00";
          $horaFechaReportefin.="$hora".":59:59";
      }
      $query=getNumberOfSells($horaFechaReporteinicio,$horaFechaReportefin);
      $row=mysqli_fetch_assoc($query);
      $num=$row["Cantidad"];
      $horaFechaReporteinicio = date("Y-m-d ");
      $horaFechaReportefin = date("Y-m-d ");
      if($num!=0) $valoresY[]=$num;
      else $valoresY[]=0;
      $valoresX[]=$hora.":00";
      $hora++;
  }
  $datosY=json_encode($valoresY);
  $datosX=json_encode($valoresX);
?>

<div class="row">
    <div class="col s12">
        <div class="card darken-1">
            <div class="card-content black-text center">
                <span class="card-title">Gráfico de Ventas del Día</span>
                <div id="grafica_dia_lineas" name="grafica_dia_lineas"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    function crearCadenaLineal(json){
        var parsed=JSON.parse(json);
        var arr=[];
        for (var x in parsed) {
            arr.push(parsed[x]);
        }
        return arr;
    }
</script>

<script type="text/javascript">
        datosY=crearCadenaLineal('<?php echo $datosY?>');
        datosX=crearCadenaLineal('<?php echo $datosX?>');
        var trace1 = {
		  x: datosX,
		  y: datosY,
		  type: 'scatter'
		};
		var data = [trace1];
		
		Plotly.newPlot('grafica_dia_lineas', data);
</script>