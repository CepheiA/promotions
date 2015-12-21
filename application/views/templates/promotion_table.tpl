 <table id="example2" class="table table-bordered table-hover">
 	<thead>
 		<tr>
 			<th>#ID</th>
 			<th>Name</th>
 			<th>Type</th>
 			<th>Description</th>
 			<th>Fecha Inicio</th>
 			<th>Fecha Termino</th>
 			<th>Acción</th>
 		</tr>
 	</thead>
 	<tbody>
 		{foreach $promotions as $key=>$promotion}
 		<tr>
 			<td>{$promotion["ID_PROMOTION"]}</td>
 			<td>{$promotion["NAME"]}</td>
 			<td>{($promotion["TYPE"] == "SPECIES")?"Especies":"Dinero"}</td>
 			<td>{$promotion["DESCRIPTION"]}</td>
 			<td>{$promotion["STARTDATE"]|date_format:"%d-%m-%Y"}</td>
 			<td>{$promotion["ENDDATE"]|date_format:"%d-%m-%Y"}</td>
 			<td>
 				<a class="col-md-6" href="#" onclick='upload({$promotion["ID_PROMOTION"]},"{$promotion["NAME"]}","{$promotion["TYPE"]}","{$promotion["DESCRIPTION"]}","{$promotion["STARTDATE"]|date_format:"%d-%m-%Y"}","{$promotion["ENDDATE"]|date_format:"%d-%m-%Y"}");return false;'>
 					<i class="fa fa-pencil"></i>
 				</a>

 				<a  class="col-md-6" href="#" onclick='removePromotion({$promotion["ID_PROMOTION"]});return false;'>
 					<i class="fa fa-remove"></i>
 				</a>
 			</td>
 		</tr>
 		{/foreach}
 	</tbody>
 </table>