# Diagramas - Sueños en Telas

Los siguientes diagramas muestran las relaciones entre las entidades del sistema "Sueños en telas" y se actualizarán a medida que avance el desarrollo del mismo.

## Diagrama de Clases UML

```mermaid
classDiagram
    %% Entidades principales
    abstract class Persona {
        #nombre: String
        #apellido: String 
        #direccion: String 
        #telefono: String 
        #email: String 
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
        #tiempoFabricacion: Integer
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
        #tipoDescuento: Enum [Fijo, Porcentaje, Promocion, Cliente Especial]
        #observaciones: String
        +calcularSubtotal()
    }

    abstract class Producto {
        #idProducto: Integer
        #nombre: String
        #descripcion: String
        #precio: Double
        #imagen: String
        #dimensiones: String
        #stockMinimo: Integer
        #stockTotal: Integer
        #tipo: Enum [Sillon, Respaldo, Otros]
        #estilo: String
        #costoFabricacion: Double
        #tiempoFabricacion: Integer
        +obtenerPrecio()
        +actualizarStock() 
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
        +obtenerCantidad()
    }
     
    class Material {
        #idMaterial: Integer
        #idProveedor: Integer
        #nombre: String
        #descripcion: String
        #precio: Double
        #imagen: String
        #dimensiones: String
        #stockMinimo: Integer
        #stockTotal: Integer
        +actualizarStock()
    }
    
    
    interface class Garantia {
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
    
    %% Herencias
    Producto <|-- Sofa
    Producto <|-- Sillon
    Producto <|-- Almohadon
    Producto <|-- Respaldo
    Persona <|-- Cliente
    Persona <|-- Usuario
    Persona <|-- Proveedor
    Garantia <|.. GarantiaBasica
    Garantia <|.. GarantiaExtendida
    
    %% Relaciones
    Cliente "1" --> "*" Venta : Realiza
    Usuario "1" --> "*" Venta : Gestiona
    Venta "1" --> "*" VentaDetalle : Contiene
    VentaDetalle "*" --> "1" Producto : Incluye
    Producto "1" --> "*" ProductoMaterial : Contiene
    ProductoMaterial "*" --> "1" Material : Utiliza
    Proveedor "1" --> "*" Material : Provisto por 
    Producto "1" --> "0..1" Garantia : Tiene
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