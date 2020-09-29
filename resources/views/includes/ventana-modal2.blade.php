<div class="modal fade" id="ventanaModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">mysql</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      


      para entrar a mysql desde xampp en la consola de comandos (hacerlo en cmd) posicionarse en xampp/mysql/bin y poner este comando <h5>mysql -u root -h localhost -p</h5>
<br>

<div  style="color: rgb(252, 122, 96);">Comandos </div>

STATUS; muestra informacion de mysql (poner primero este comando)<br>
SHOW DATABASES; muestra las bases de datos <br>
CREATE DATABASE NOMBRRE_DE_DB; crea una base de datos <br>
DROP DATABASE NOMBRRE_DE_DB; borra la base de datos <br>
USE NOMBRRE_DE_DB; posicinarse en la base de datos para poder crear tablas borrarlas etc.. <br>
si colocamos esto te creA la tabla= <br>
CREATE TABLE usuarios ( <br>

id int(11), <br>
nombre varchar(100), <br>
apellido varchar(255), <br>
email varchar(100), <br>
password varchar(255) <br>



); <br>

SHOW TABLES; muestra las TABLAS <br>
desc usuarios; describe la tabla usuarios<br>
drop table usuarios; borra la tabla usuarios <br>

<div  style="color: rgb(252, 122, 96);">phpmyadmin (agregar un nuevo usuario)<br></div>
hacer click en la casita o sea inicio y poner cuentas de usuario agregar un nuevo usuario <br>
completo poniendo nombre de usuario servidor local seguro contraseña otorgar todos los privilegios, privilegios globales selecciono todo
si me tira error voy a la consola de comandos posicionarse en xammp/mysql/bin y pongo= <br> <h3>mysql -u root -h localhost -p</h3> <br>
CLAVE FORANIA ES UN CAMPO Q SE VA GUARDAR ALGO DE OTRA TABLA COMO POR EJEMPLO EN TABLA USUARIO EL ID_CATEGORIA SE VA A GUARDAR EL ID DE LA CATEGORIA



<div  style="color: rgb(252, 122, 96);">Crear tabla </div>

CREATE TABLE usuarios (<br>

id int(11) auto_increment not null,   /*auto_increment se puede usuar cuando hay una primary key not null quiere decir q siempre tiene q haber un dato ahi*/ <br>
nombre varchar(100) default 'hola q tal', /*default q por defecto va tener hola q tal*/<br>
apellido varchar(255) null, /*null que sea nulo*/<br>
email varchar(100),<br>
password varchar(255),<br>
CONSTRAINT pk_usuarios PRIMARY KEY(id) /*LE INDICO LA CLAVE PRYMARIA SE PONE TODOO ESTO*/<br>

);<br>

<h3>otro ejemplo</h3>

CREATE TABLE usuarios( <br>
id          int(255) auto_increment not null,<br>
nombre      varchar(100) not null,<br>
apellidos   varchar(100) not null,<br>
email       varchar(255) not null,<br>
password    varchar(255) not null,<br>
fecha       date not null,<br>
CONSTRAINT pk_usuarios PRIMARY KEY(id),<br>
CONSTRAINT uq_email UNIQUE(email)/*QUE EL EMAIL NO PUEDE SER REPETIDO*/<br>
)ENGINE=InnoDb;<br>

CREATE TABLE categorias(<br>
id      int(255) auto_increment not null,<br>
nombre  varchar(100),<br>
CONSTRAINT pk_categorias PRIMARY KEY(id)<br>
)ENGINE=InnoDb;/*LE ESTAMOS INDICANDO EL MOTOR DE ALMACENAR A MYSQL Y HACE Q FUNCIONE LA RELACION PERFECTAMENTE O SEA MEJORA EL RENDIMIENTO DE LOS INSER UPDATE */<br>

CREATE TABLE entradas(<br>
id              int(255) auto_increment not null,<br>
usuario_id      int(255) not null,<br>
categoria_id    int(255) not null,<br>
titulo          varchar(255) not null,<br>
descripcion     MEDIUMTEXT, /*AGUANTA MUCHO MAS CARACTERES QUE VARCHAR */<br>
fecha           date not null,<br>
CONSTRAINT pk_entradas PRIMARY KEY(id), /*CONSTRAINT SIGNIFICA RSTRICCION*/<br>
CONSTRAINT fk_entrada_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id),/*ESTOY INDICANDO LA RELACION<br>
CONSTRAINT RESTRICCION CON fk_entrada_categoria DE NOMBRE FOREIGN KEY EL CAMPO AJENO QUE HACE REFERENCIA REFERENCES O SEA Q LO SACO DE usuarios(id*/<br>
CONSTRAINT fk_entrada_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id) ON DELETE NO ACTION /*ON DELETE CASCADE SIGNIFICA QUE CUANDO SE BORRE EL ID DE CATEGORIAS DE ESTA TABLA ENTRADAS<br>
TAMBIEN SE BORRE EL REGISTRO CON EL CUAL ESTA RELACIONADA ON DELETE SET NULL Q CUANDO SE BORRE SE PONGA EN NULL ON DELETE SET DEFAULT Q SE PONGA EN DEFAULT CUANDO SE BORRE<br>
NO ACTION Q NO HAGA NADA*/<br>
)ENGINE=InnoDb;<br>

<div  style="color: rgb(252, 122, 96);">Modificar tabla </div>

# RENOMBRAR UNA TABLA # <br>
ALTER TABLE usuarios RENAME TO usuarios_renom;<br>

# CAMBIAR NOMBRE DE UNA COLUMNA #<br>
ALTER TABLE usuarios_renom CHANGE apellidos apellido varchar(100) null;<br>

# MODIFICAR COLUMNA SIN CAMBIAR NOMBRE o sea cambiar la restrincion si es chart esas cosas#<br>
ALTER TABLE usuarios_renom MODIFY apellido char(40) not null;<br>

# AÑADIR COLUMNA #<br>
ALTER TABLE usuarios_renom ADD website varchar(100) null;<br>

# AÑADIR RESTRICCIÓN A COLUMNA para que el campo sea unico#<br>
ALTER TABLE usuarios_renom ADD CONSTRAINT uq_email UNIQUE(email);<br>

# BORRAR UNA COLUMNA #<br>
ALTER TABLE usuarios_renom DROP website;<br>


#BORRAR REGISTROS# <br>
DELETE FROM usuarios WHERE email = 'admin@admin.com'; <br>

#INSERTAR NUEVOS REGISTROS# <br>
INSERT INTO usuarios VALUES(null, 'Víctor', 'Apellidos', 'victor@victor.com', '1234', '2019-05-01'); <br>
#INSERTAR FILAS SOLO CON CIERTAS COLUMNAS# <br>
INSERT INTO usuarios(email, password) VALUES('admin@admin.com', 'admin'); <br>

<div  style="color: rgb(252, 122, 96);">EJEMPLO DE COMO GENERAR CONSULTAS </div>

CREATE DATABASE IF not EXISTS concesionario; <br>
use concesionario;<br>

create TABLE coches(<br>
id int(10) auto_increment not null,<br>
modelo varchar(255) not null,<br>
marca varchar(50),<br>
precio int(20) not null,<br>
stock int(10) not null,<br>
CONSTRAINT pk_coches PRIMARY KEY(id)<br>

)ENGINE=InnoDB;<br>


create TABLE GRUPOS(<br>
id int(10) auto_increment not null,<br>
nombre varchar(20) not null,<br>
ciudad varchar(20),<br>
CONSTRAINT pk_grupos PRIMARY key(id)<br>
)ENGINE=InnoDB;<br>

CREATE table vendedores(<br>
  id int(10) auto_increment not null,<br>
  grupo_id int(10) not null,<br>
  jefe int(20),<br>
  nombre varchar(20) not null,<br>
  apellido varchar(20) not null,<br>
  cargo varchar(20) not null,<br>
  fecha date,<br>
  sueldo int(20),<br>
  comision float(10,2),<br>
  CONSTRAINT pk_vendedores PRIMARY KEY(id),<br>
  CONSTRAINT fk_vendedor_grupo FOREIGN KEY(grupo_id),<br>
  CONSTRAINT fk_vendedor_jefe FOREIGN KEY(jefe),<br>
)ENGINE=InnoDB;<br>
/*<br>
 3. Incrementar el precio de los coches en un dos poriciento.<br>
  */<br>

  UPDATE coches set precio = precio*1.05;<br>
 /*<br>
   5. Mostrar todos los vendedores con su nombre y el numero de dias que llevan<br>
   en el concesionario.<br>
    */<br>

    DATEDIFF(CURDATE(), fecha)<br>

 /*<br>
    6. Visualizar el nombre y los apellidos de los vendedores en una misma columna,<br>
    su fecha de registro y el dia de la semana en la que se registraron.<br>
     */DAYNAME(fecha)<br>

  11. Visualizar todos los cargos y el numero de vendedores que hay en cada cargo<br>
          */<br>


          SELECT cargo ,COUNT(id) from vendedores GROUP BY cargo;<br>

 /*<br>
           13. Sacar la media de sueldos (mostrarlo en entero) entre todos los vendedores por grupo y q me muestre el nombre del grupo y la ciudad<br>
            */<br>


            SELECT CEIL(AVG(v.sueldo)) as 'media salarial', g.nombre , g.ciudad from vendedores v<br>
            INNER JOIN grupos g on g.id = v.grupo_id<br>
            GROUP BY grupo_id;<br>

 /*<br>
            14. Visualizar las unidades totales vendidas de cada coche a cada cliente.<br>
            Mostrando el nombre del coche, nombre de cliente y la suma de unidades.<br>
             */<br>


             SELECT c.modelo as 'modelo', cl.nombre as 'nombre',e.cantidad as 'unidad' from encargos e<br>
             INNER JOIN coches c on c.id = e.coche_id<br>
             INNER JOIN clientes cl on cl.id = e.cliente_id;<br>

 /*<br>
             15. Mostrar los nombres de los clientes que más encargos han hecho y mostrar cuantos hicieron maximo 2 clientes<br>
              */<br>


              SELECT cl.nombre, count(e.id) from encargos e<br>
              INNER JOIN clientes cl on cl.id = e.cliente_id<br>
               GROUP by e.cliente_id ORDER by 2 DESC limit 2;/*si pongo un numero 2 en este caso despues del ORDER BY significa q tomo el campo e.id despues del selec*/<br>

               /*<br>
               16. Obtener listado de clientes atendidos por el vendedor 'David Lopez'<br>
                */<br>

                select * from clientes WHERE vendedor_id in /*aca pondria un = y todo bien pero pongo IN para q me devuelva multiples resultados ya q david lopez pueden haber muchos*/<br>
                (select id from vendedores WHERE nombre = 'David' and apellidos = 'Lopez');/*me saca un id del vendedor y lo comparo con vendedor_id*/<br>
              

                /*<br>
                17. Obtener listado con los encargos realizados por el cliente 'Fruteria Antonia Inc'<br>
                 */<br>


                 SELECT * from encargos e<br>
                 INNER JOIN clientes c on c.id = e.cliente_id /*porqe voy a usar tabla clientes */<br>
                 WHERE e.cliente_id in /*IN es como el igual pero me saca multiples resultados*/<br>
                  (select id from clientes WHERE nombre = 'Fruteria Antonia Inc');/*esto me saca el id del cliente para comparar con e.cliente_id*/<br>

  /*<br>
                  18. Listar los clientes que han hecho algun encargo del coche "Mercedes Ranchera"<br>
                   */<br>

                   SELECT * FROM clientes WHERE id IN<br>
                   (SELECT cliente_id FROM encargos WHERE coche_id<br>
                       IN (SELECT id FROM coches WHERE modelo LIKE '%Mercedes Ranchera%'));<br>


                       /*<br>
                       19. Obtener los vendedores con 2 o más clientes.<br>
                        */<br>

                        select nombre from vendedores WHERE id IN<br>
                        (SELECT vendedor_id from clientes GROUP by vendedor_id HAVING count(id) >= 2);/*los agrupa para contarlos por cada fila del vendedor_id cuenta id */<br>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>