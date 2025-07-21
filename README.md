# Sueños en Telas
El siguiente proyecto fue gestionado como parte de la tesis para la carrera Analista en Sistemas y engloba la logica de negocio que utilizará <b>Sueños en Telas</b>, entidad que se dedica a la fabricación, restauración y tapicería de distintos tipos de muebles de interior y dándoles un estilo único e innovador. El servicio buscará cubrir las necesidades basicas de la empresa e incrementará segun las necesidades de la misma, pasando por la carga de ventas, la gestion de las garantias, el control de stock de sus materiales, la posibilidad de gestionar usuarios y clientes, entre otros apartados. 
A continuacion se detallan los pasos de instalacion de la aplicacion (a partir de ahora llamado <b>SET</b>) y las principales caracteristicas que posee:

## Instalacion
SET utiliza <b>>Laravel Framework</b> y está pensado para utilizar una base de datos <b>MySql</b> para su funcionamiento, pero siempre se puede modificar la base de datos desde las variables de entorno.
Es necesario tener instalado en el sistema PHP >= 8.2, Composer y Laravel 12. Luego de tener dichos requerimientos, los pasos a seguir son:

- Clonar este repositorio

``` 
git clone  https://github.com/matiasgomez05/ 
cd
```

- Instalar las dependencias de PHP y Laravel

```
composer install
```

- Copiar y actualizar el archivo `.env` con los datos de conexion a la base de datos

```
cp .env.example .env
```

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

- Generar la clave única para el funcionamiento de la aplicacion

```
php artisan key:generate
```

- Ejecutar las migraciones. Esto creará las tablas necesarias para que el sistema funcione correctamente

```
php artisan migrate
```

- Poblar la base de datos con los registros iniciales: provincias y localidades argentinas, usuario administrador, entre otros.

```
php artisan db:seed
```

- Ejecutar el servidor e ingresar al link de localhost para utilizar el programa

```
composer run dev
``` 


## Diagramas

Los siguientes diagramas muestran las relaciones entre las entidades del sistema "Sueños en telas" y se actualizarán a medida que avance el desarrollo del mismo.

### Diagrama de Clases UML

```mermaid
classDiagram
    %% Entidades principales

    class Pais {
        #idPais: Integer
        #nombre: String
    }

    class Provincia {
        #idProvincia: Integer
        #idPais: Integer
        #nombre: String
    }
    
    class Partido {
        #idPartido: Integer
        #idProvincia: Integer
        #nombre: String
    }

    class Localidad {
        #idLocalidad: Integer
        #idPartido: Integer
        #nombre: String
    }

    class Direccion {
        #idDireccion: Integer
        #idLocalidad: Integer
        #calle: String
        #numero: Integer
        #piso: Integer
        #codigoPostal: Integer
    }

    class Persona {
        #nombre: String
        #apellido: String 
        #telefono: String 
        #email: String 
        #idDireccion: Integer
        #fechaRegistro: Date
        #ultimaActualizacion: Date
        +obtenerNombreCompleto(): String
        +actualizarContacto(nombre: String, apellido: String, direccion: String, telefono: String, email: String): Void
    }

    class Cliente {
        #idCliente: Integer 
        +obtenerHistorialCompras()
    }

    class Usuario {
        #idUsuario: Integer 
        #username: String 
        #password: String 
        #activo: Boolean 
        #esAdmin: Boolean
        +login()
        +cambiarPassword()
    }
    
    class Proveedor {
        #idProveedor: Integer 
        +empresa: String 
        +obtenerCatalogo()
    }

    class Venta {
        #idVenta: Integer
        #idCliente: Integer
        #idUsuario: Integer
        #fechaVenta: Date
        #fechaEntrega: Date
        #estado: Enum [En proceso, Entregado, Cancelado]
        #total: Double
        +calcularTotal(): Double
        +agregarProducto(producto: Producto, cantidad: Integer): Void
        +procesarPago()
    }

    class VentaDetalle {
        #idVentaDetalle: Integer
        #idVenta: Integer
        #idProducto: Integer
        #cantidad: Integer
        #precioUnitario: Double
        #subtotal: Double
        #descuento: Double
        #tipoDescuento: Enum [Fijo, Porcentaje, Promocion, Cliente Especial]
        #observaciones: String
        +calcularSubtotal()
    }

    class Inventario {
        #nombre: String
        #descripcion: String
        #precio: Double
        #imagen: String
        #dimensiones: String
        #color: String
        #stockMinimo: Integer
        #stockDisponible: Integer
        #stockReservado: Integer
        #stockTotal: Integer
        #medida: Enum [Centimetros, Gramos, Unidades]
        +actualizarStock() 
        +verificarStock()
    }

    class ManoDeObra {
        #idManoDeObra: Integer
        #idProducto: Integer
        #idUsuario: Integer
        #fechaHora: Datetime
        #horasTrabajadas: Double
        #costoHora: Double
        #costoTotal: Double
        #observaciones: String
    }

    class Producto {
        #idProducto: Integer
        #tipo: Enum [Sofa, Sillon, Almohadon, Respaldo, Otros]
        #estilo: String
        #costoFabricacion: Double
        #tiempoFabricacion: Integer
        #medidaFabricacion: Enum [Hora, Dia, Mes]
    }
    
    class Sofa {
        #numeroCuerpos: Integer
        +obtenerCapacidad()
    }
    
    class Sillon {
        #reclinable: Boolean
        +obtenerEstilo()
    }
    
    class Almohadon{
         #relleno: Enum [Vellon, Algodon, Otro]
    }

    class Respaldo {
        #diseño: Enum [Marco, Bastones, Geometrico, Otro]
    }

    class ProductoMaterial {
        #idProductoMaterial: Integer
        #idProducto: Integer
        #idMaterial: Integer
        #cantidadUtilizada: Integer
        #medidaUtilizada: Enum [Centimetros, Gramos, Unidades]
        +obtenerCantidad()
    }

    class MovimientoMaterial {
        #idMovimientoMaterial: Integer
        #idUsuario: Integer
        #idMaterial: Integer
        #tipo: Enum [Compra, Reserva, Consumo, Ajuste]
        #fechaHora: Datetime
        #cantidad: Integer
        #medida: Enum [Centimetros, Gramos, Unidades]
        #stockAnterior: Integer
        #stockNuevo: Integer
        #observacion: String
    }
     
    class Material {
        #idMaterial: Integer
        #idProveedor: Integer
    }
    
    class Garantia {
        +verificarVigencia()
    }
    
    class GarantiaBasica {
        #idGarantia: Integer
        #idProducto: Integer
        #fechaInicio: Date
        #fechaFin: Date
        +verificarVigencia()
    }
    
    class GarantiaExtendida {
        #idGarantia: Integer
        #idProducto: Integer
        #fechaInicio: Date
        #fechaFin: Date
        #costoAdicional: Double 
        +verificarVigencia()
    }

    %% Anotaciones    
    <<abstract>> Persona
    <<abstract>> Producto
    <<abstract>> Inventario
    <<interface>> Garantia
    
    %% Herencias
    Inventario <|-- Material : Parte del
    Inventario <|-- Producto : Parte del
    Producto <|-- Sofa : Es un
    Producto <|-- Sillon : Es un
    Producto <|-- Almohadon : Es un
    Producto <|-- Respaldo : Es un
    Persona <|-- Cliente : Es una
    Persona <|-- Usuario : Es una
    Persona <|-- Proveedor : Es una
    Garantia <|.. GarantiaBasica 
    Garantia <|.. GarantiaExtendida
    
    %% Relaciones
    Pais "1" --> "*" Provincia : Tiene
    Provincia "1" --> "*" Localidad: Tiene
    Localidad "1" --> "*" Direccion: Tiene
    Direccion "1" --> "*" Persona: Tiene
    Cliente "1" --> "*" Venta : Realiza
    Usuario "1" --> "*" Venta : Gestiona
    Usuario "1" --> "*" MovimientoMaterial : Gestiona
    Usuario "1" --> "*" ManoDeObra : Gestiona
    Venta "1" --> "*" VentaDetalle : Contiene
    VentaDetalle "*" --> "1" Producto : Incluye
    Producto "1" --> "*" ProductoMaterial : Contiene
    Producto "1" --> "0..1" Garantia : Tiene
    Producto "1" --> "1" ManoDeObra : Tiene
    ProductoMaterial "*" --> "1" Material : Utiliza
    MovimientoMaterial "*" --> "1" Material : Registra
    Proveedor "1" --> "*" Material : Provisto por 
```

## Diagrama de Entidad-Relación

```mermaid
erDiagram
    PRODUCTO {
        string id PK
        string nombre
        string descripcion
        double precio
        string categoria
    }
    
    SOFA {
        string id PK
        string tipo
        int capacidad
        string material
    }
    
    SILLON {
        string id PK
        string estilo
        boolean reclinable
    }
    
    PERSONA {
        string id PK
        string nombre
        string apellido
        string email
        string telefono
    }
    
    CLIENTE {
        string id PK
        string numeroCliente
        string direccion
        date fechaRegistro
    }
    
    USUARIO {
        string id PK
        string username
        string password
        string rol
        boolean activo
    }
    
    PROVEEDOR {
        string id PK
        string codigoProveedor
        string empresa
        string direccion
    }
    
    VENTA {
        string id PK
        string numeroVenta
        date fecha
        double total
        string estado
    }
    
    VENTA_DETALLE {
        string id PK
        int cantidad
        double precioUnitario
        double subtotal
    }
    
    MATERIAL {
        string id PK
        string nombre
        string descripcion
        double precio
        int stock
    }
    
    PRODUCTO_MATERIAL {
        string id PK
        int cantidad
    }
    
    GARANTIA {
        string id PK
        date fechaInicio
        date fechaFin
        string tipo
        boolean activa
    }
    
    GARANTIA_BASICA {
        string id PK
        int mesesDuracion
        string cobertura
    }
    
    GARANTIA_EXTENDIDA {
        string id PK
        int mesesAdicionales
        double costoAdicional
        string coberturaExtendida
    }
    
    PRODUCTO ||--o{ SOFA : "es un"
    PRODUCTO ||--o{ SILLON : "es un"
    PERSONA ||--o{ CLIENTE : "es un"
    PERSONA ||--o{ USUARIO : "es un"
    PERSONA ||--o{ PROVEEDOR : "es un"
    GARANTIA ||--o{ GARANTIA_BASICA : "es una"
    GARANTIA ||--o{ GARANTIA_EXTENDIDA : "es una"
    
    CLIENTE ||--o{ VENTA : "realiza"
    USUARIO ||--o{ VENTA : "procesa"
    VENTA ||--o{ VENTA_DETALLE : "contiene"
    VENTA_DETALLE }o--|| PRODUCTO : "incluye"
    PRODUCTO ||--o{ PRODUCTO_MATERIAL : "requiere"
    PRODUCTO_MATERIAL }o--|| MATERIAL : "usa"
    PROVEEDOR ||--o{ MATERIAL : "suministra"
    PRODUCTO }o--o| GARANTIA : "tiene"
```

## Diagrama de Secuencia - Proceso de Venta

```mermaid
sequenceDiagram
    participant C as Cliente
    participant U as Usuario
    participant V as Venta
    participant P as Producto
    participant G as Garantia
    
    C->>U: Solicitar compra
    U->>V: Crear venta
    U->>P: Verificar disponibilidad
    P-->>U: Stock disponible
    U->>V: Agregar productos
    U->>G: Verificar garantía
    G-->>U: Información garantía
    U->>V: Calcular total
    V-->>U: Total calculado
    U-->>C: Mostrar total
    C->>U: Confirmar pago
    U->>V: Procesar venta
    V-->>U: Venta completada
    U-->>C: Confirmación venta
```