function reloj(){
            var fecha= new Date();
            var horas= fecha.getHours();
            var minutos = fecha.getMinutes();
            var segundos = fecha.getSeconds();
            
            str_segundo = new String (segundos) 
            if (str_segundo.length == 1) 
      	    segundos = "0" + segundos 

   	        str_minuto = new String (minutos) 
             	if (str_minuto.length == 1) 
      	        minutos = "0" + minutos

   	        str_hora = new String (horas) 
   	            if (str_hora.length == 1) 
      	          horas = "0" + horas 
            
            document.getElementById('contenedor').innerHTML=''+'Hora: '+horas+':'+minutos+':'+segundos+'';
            setTimeout('reloj()',1000);
            }
