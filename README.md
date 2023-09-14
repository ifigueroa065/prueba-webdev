# Prueba Desarrollador Web :green_apple:
Desarrollando un crud utilizando php y mysql


## ¿Qué necesitas para este proyecto? 

### :orange_book: XAMPP 
    https://www.apachefriends.org/es/index.html

### :blue_book: Tienes problemas con el puerto de mysql?
    https://www.youtube.com/watch?v=RF5PDcrEYmU

### :b: Bootstrap

```html
   <head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

```

## Detalle de la prueba

Realizar una aplicación con lo siguiente:

### Crear una pantalla tipo CRUD de una tabla que tenga los siguientes campos 

- Fecha del dia
- ld
- Nombre
- Edad
- Fecha de inicio de estudios de Primaria
- Fecha de inicio de estudios de Secundaria

### Condiciones:
* Los datos deberá almacenarse en una tabla de una db de mysal.
* Validar fecha del día automático no editable.
* Validar Id con correlativo automático no editable.
* Validar Nombre solo permita caracteres en Mayúscula.
* La edad solo puede ser de 30 a 99 años
* Validar que la diferencia de fechas no puede ser mayor de 9 años y que no
puede ser menor de 3 exactos.

De cada registro el usuario podrá generar una consulta
que despliegue del rango de fechas periodos mensuales
ordenados descendentemente con el siguiente formato:
añomes, ejemplo: 2018oct, 2018sep, etc.

Generar una consulta que indique el total de días, meses
y años del rango de las fechas del registro.

Crear pantalla de login para llegar a este CRUD. Esta
pantalla de Login debe llevar usuario y contraseña. Debe
de tener opción a registrar usuarios nuevos. (no es
necesario validar el usuario nuevo con correo.)

Que la contraseña sea almacenada en una tabla de la
base de datos y que se guarde con método de
encriptación MDS u otro compatible.

Publicar el proyecto. Para que pueda usarse de un
navegador.

### :pushpin: Recomendaciones para la prueba:

* Si tiene código desarrollado en otros proyectos que hayan realizado, puede reutilizar código.

* Pueden apoyarse en consultas y tutoriales otras paginas para realizar
esta prueba.

Si requiere de mas tiempo para terminar la prueba puede solicitarlo.
