 <?php
  require_once("util.php");
  
  date_default_timezone_set('America/Mexico_City');
  $horaFechaReporteinicio = date("Y-m-d 00:00:00");
  $horaFechaReportefin = date("Y-m-d 23:59:59");
  $query=getReporteProductosVendidos($horaFechaReporteinicio,$horaFechaReportefin);
  $labels=array();
  $quantity=array();
  $size=0;
  for($i=0; $i<mysqli_num_rows($query); $i++){
        $row=mysqli_fetch_assoc($query);
        if($row["Total"]!=0){
            $quantity[]=$row["Total"];
            $labels[]=$row["nombre"];
            $size++;
            
        }
  }
  
  //for($i=0; $i<$size; $i++) echo $labels[$i];
  //for($i=0; $i<$size; $i++) echo $quantity[$i];
  $datosLabels=json_encode($labels);
  $datosQuantity=json_encode($quantity);
  
?>

<div class="row">
    <div class="col s12">
        <div class="card darken-1">
            <div class="card-content black-text center">
                <span class="card-title">Gráfico de Productos Vendidos durante el Día</span>
                <div id="grafica_dia_prodcutos_pastel" name="grafica_dia_prodcutos_pastel"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    function crearArreglo(json){
        var parsed=JSON.parse(json);
        var arr=[];
        for (var x in parsed) {
            arr.push(parsed[x]);
        }
        return arr;
    }
</script>

<script type="text/javascript">
    etiquetas=crearArreglo('<?php echo $datosLabels ?>');
    valores=crearArreglo('<?php echo $datosQuantity ?>');
    var data = [{
      values: valores,
      labels: etiquetas,
      type: 'pie'
    }];
    
    var layout = {
      height: 400,
      width: 500
    };
    
    Plotly.newPlot('grafica_dia_prodcutos_pastel', data, layout);
</script>