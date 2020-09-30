<?php 

    $re = mysqli_query($conectar, "SELECT * FROM `turnos` WHERE `tur_prof` = '$turno'");
                                    //se inicia ciclo while para imprimir datos en la tabla
                                    while ($row5 = mysqli_fetch_row($re)) {

                                    echo '<tr">
                                    <th>'.$row5[0].'</th>
                                    <th>'.$row5[1].'</th>
                                    <th>'.$row5[2].'</th>
                                    <th id="thdispo"> </th>
                                    <form id="form-desbloqueo" method="post" action="agendar_tutoria_estu.php">
                                    <input type="hidden" class="form-control" name="codig_prof" value="'.$codig_prof.'">
                                    <input type="hidden" class="form-control" name="fechas" value="'.$fechas.'">
                                    <input type="hidden" class="form-control" name="turno" value="'.$row5[0].'">
                                    <th>
                                    <div class="form-group">
                                    <select class="custom-select" name="motivo" required>
                                    <option value="">Seleccione un motivo</option>
                                    <option value="Consulta General">Consulta General</option>
                                    <option value="Planeacion Curricular">Planeacion curricural</option>
                                    <option value="Seguimiento a rendimiento">Seguimiento a rendimiento</option>
                                    <option value="Orientacion">Orientacion</option>
                                    <option value="Otro">Otro</option>
                                    </select>
                                    </div> 
                                    </th>
                                    <th><button type="submit" class="btn btn-success" name="confirmar_reserva">CONFIRMAR RESERVA</button></th>
                                    </form>
                                    </tr>';

                                        }
     ?>