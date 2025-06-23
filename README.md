# Diagrama UML - Sueños en Telas

Los siguientes diagramas muestran las relaciones entre las entidades del sistema "Sueños en telas" y se actualizarán a medida que avance el desarrollo del mismo.

## Diagrama de Clases

```mermaid
classDiagram
    %% Entidades principales
    class Producto {
        +String nombre
        +String descripcion
        +Double precio
        +String categoria
        +obtenerPrecio()
        +actualizarStock()
    }
    
    class Sofa {
        +String tipo
        +Integer capacidad
        +String material
        +obtenerCapacidad()
    }
    
    class Sillon {
        +String estilo
        +Boolean reclinable
        +obtenerEstilo()
    }
    
    class Persona {
        +String nombre
        +String apellido
        +String email
        +String telefono
        +obtenerNombreCompleto()
        +actualizarContacto()
    }
    
    class Cliente {
        +String numeroCliente
        +String direccion
        +Date fechaRegistro
        +obtenerHistorialCompras()
    }
    
    class Usuario {
        +String username
        +String password
        +String rol
        +Boolean activo
        +autenticar()
        +cambiarPassword()
    }
    
    class Proveedor {
        +String codigoProveedor
        +String empresa
        +String direccion
        +obtenerCatalogo()
    }
    
    class Venta {
        +String numeroVenta
        +Date fecha
        +Double total
        +String estado
        +calcularTotal()
        +procesarPago()
    }
    
    class VentaDetalle {
        +Integer cantidad
        +Double precioUnitario
        +Double subtotal
        +calcularSubtotal()
    }
    
    class Material {
        +String nombre
        +String descripcion
        +Double precio
        +Integer stock
        +actualizarStock()
    }
    
    class ProductoMaterial {
        +Integer cantidad
        +obtenerCantidad()
    }
    
    class Garantia {
        +Date fechaInicio
        +Date fechaFin
        +String tipo
        +Boolean activa
        +verificarVigencia()
    }
    
    class GarantiaBasica {
        +Integer mesesDuracion
        +String cobertura
        +obtenerCobertura()
    }
    
    class GarantiaExtendida {
        +Integer mesesAdicionales
        +Double costoAdicional
        +String coberturaExtendida
        +calcularCosto()
    }
    
    %% Herencias
    Producto <|-- Sofa
    Producto <|-- Sillon
    Persona <|-- Cliente
    Persona <|-- Usuario
    Persona <|-- Proveedor
    Garantia <|-- GarantiaBasica
    Garantia <|-- GarantiaExtendida
    
    %% Relaciones
    Cliente "1" --> "*" Venta : realiza
    Usuario "1" --> "*" Venta : procesa
    Venta "1" --> "*" VentaDetalle : contiene
    VentaDetalle "*" --> "1" Producto : incluye
    Producto "1" --> "*" ProductoMaterial : requiere
    ProductoMaterial "*" --> "1" Material : usa
    Proveedor "1" --> "*" Material : suministra
    Producto "1" --> "0..1" Garantia : tiene
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