
/*Creacion de la BD*/
CREATE DATABASE `usuarios_gml` ;


/*
 * Consulta de Usuarios
 */
SELECT 
usu.nombres,
usu.apellidos,
usu.cedula,
usu.email,
usu.celular,
usu.direccion,
p.nombre_pais,
c.categoria,
usu.created_at  as fecha_ingreso
FROM usuarios as usu
join paises as p on usu.id_pais = p.id 
join categorias c  on usu.id_categoria = c.id  


/*
* Consulta de cantidad de Usarios por Pais
*/

SELECT 
COUNT(u.id) as cantidad,
p.nombre_pais as pais
FROM usuarios u 
join paises p  on u.id_pais = p.id
GROUP BY pais