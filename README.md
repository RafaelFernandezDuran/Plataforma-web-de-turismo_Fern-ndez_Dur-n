# 🌿 Chanchamayo Tours

**Plataforma web de turismo para Chanchamayo, Perú**

Marketplace digital que conecta empresas turísticas locales con visitantes interesados en explorar la región de Chanchamayo. Sistema completo de gestión de tours, reservas online y experiencias de aventura en la naturaleza.

## 🚀 Características Principales

### Para Turistas
- 🔍 **Explorar Tours**: Catálogo completo con filtros avanzados por categoría, precio, duración y dificultad
- 📋 **Información Detallada**: Itinerarios completos, servicios incluidos/excluidos, galería de fotos
- 💳 **Sistema de Reservas**: Booking online con selección de fechas y número de participantes
- ⭐ **Reseñas y Calificaciones**: Sistema de valoraciones y comentarios
- 📱 **Diseño Responsive**: Optimizado para móviles, tablets y desktop

### Para Empresas Turísticas
- 🏢 **Registro de Empresa**: Proceso de alta como operador turístico verificado
- ✏️ **Gestión de Tours**: CRUD completo - crear, editar, publicar y gestionar tours
- 📊 **Dashboard Empresarial**: Panel de control con estadísticas y métricas
- 📅 **Gestión de Reservas**: Administración completa de bookings recibidos
- 🎯 **Control de Estado**: Activar/desactivar tours y gestionar disponibilidad

## 🛠️ Stack Tecnológico

### Backend
- ![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat&logo=laravel&logoColor=white) **Framework PHP moderno**
- ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white) **Base de datos relacional**
- ![Eloquent](https://img.shields.io/badge/Eloquent-ORM-FF2D20?style=flat) **Mapeo objeto-relacional**
- ![Laravel Auth](https://img.shields.io/badge/Laravel-Auth-FF2D20?style=flat) **Sistema de autenticación multi-rol**

### Frontend
- ![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat&logo=html5&logoColor=white) **Estructura semántica moderna**
- ![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat&logo=css3&logoColor=white) **Estilos avanzados con Flexbox/Grid**
- ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat&logo=javascript&logoColor=black) **Vanilla JS para máximo rendimiento**
- ![Font Awesome](https://img.shields.io/badge/Font_Awesome-528DD7?style=flat&logo=fontawesome&logoColor=white) **Iconografía profesional**

### Herramientas de Desarrollo
- ![Composer](https://img.shields.io/badge/Composer-885630?style=flat&logo=composer&logoColor=white) **Gestión de dependencias PHP**
- ![Git](https://img.shields.io/badge/Git-F05032?style=flat&logo=git&logoColor=white) **Control de versiones**
- ![VS Code](https://img.shields.io/badge/VS_Code-007ACC?style=flat&logo=visualstudiocode&logoColor=white) **Editor de desarrollo**

## 📁 Arquitectura del Proyecto

```
chanchamayo-tours/
├── 📁 app/
│   ├── Http/Controllers/     # Lógica de controladores MVC
│   ├── Models/              # Modelos Eloquent y relaciones
│   └── Providers/           # Proveedores de servicios Laravel
├── 📁 database/
│   ├── migrations/          # Esquemas de base de datos
│   ├── seeders/            # Datos de prueba y producción
│   └── factories/          # Factories para testing
├── 📁 public/
│   ├── css/                # Estilos CSS organizados
│   ├── images/             # Assets e imágenes
│   └── index.php           # Punto de entrada público
├── 📁 resources/
│   └── views/              # Templates Blade organizados
├── 📁 routes/
│   └── web.php             # Definición de rutas web
└── 📁 storage/            # Logs y archivos temporales
```

## 🎨 Características de Diseño

- **🎭 Diseño Moderno**: Interfaz premium con efectos glassmorphism y gradientes
- **📱 Mobile-First**: Completamente responsive y optimizado para móviles
- **⚡ Microinteracciones**: Animaciones fluidas y transiciones suaves
- **♿ Accesibilidad**: Navegación por teclado, semántica HTML5 y ARIA labels
- **🚀 Performance**: Lazy loading de imágenes y optimización de recursos

## 📊 Modelo de Base de Datos

### Entidades Principales
- **👥 Users**: Sistema de usuarios con roles diferenciados
- **🏢 Companies**: Perfil completo de empresas turísticas
- **🗺️ Tours**: Catálogo detallado con ubicación, precios y servicios
- **📂 TourCategories**: Taxonomía de tipos de turismo
- **📋 Bookings**: Sistema de reservas con estados y tracking
- **⭐ Reviews**: Reseñas, calificaciones y experiencias de usuarios

## 🚀 Guía de Instalación

### Prerrequisitos del Sistema
- **PHP >= 8.2** con extensiones requeridas
- **Composer** para gestión de dependencias
- **MySQL/MariaDB** como base de datos
- **XAMPP/LAMP/WAMP** (opcional para desarrollo local)

### Proceso de Instalación

1. **📥 Clonar Repositorio**
   ```bash
   git clone https://github.com/RafaelFernandezDuran/Plataforma-web-de-turismo_Fern-ndez_Dur-n.git
   cd Plataforma-web-de-turismo_Fern-ndez_Dur-n
   ```

2. **📦 Instalar Dependencias**
   ```bash
   composer install
   ```

3. **⚙️ Configurar Variables de Entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **🗄️ Configurar Base de Datos**
   Editar archivo `.env` con credenciales:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=chanchamayo_tours
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **🏗️ Ejecutar Migraciones y Datos de Prueba**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **🌐 Iniciar Servidor de Desarrollo**
   ```bash
   php artisan serve
   ```

7. **✅ Acceder a la Aplicación**
   - **URL Principal**: http://localhost:8000
   - **Panel Admin**: http://localhost:8000/dashboard

## 📋 Funcionalidades Implementadas

### ✅ Sistema de Autenticación
- Registro y login multi-rol (usuarios/empresas)
- Middleware de protección de rutas
- Gestión de sesiones seguras

### ✅ Gestión Completa de Tours
- CRUD completo con validaciones
- Sistema de categorización avanzado
- Filtros dinámicos y búsqueda
- Galería de imágenes con lightbox
- Estados de publicación (borrador/activo/inactivo)

### ✅ Sistema de Reservas
- Booking online con calendario
- Gestión de disponibilidad
- Estados de reserva trackeable
- Notificaciones automáticas

### ✅ Experiencia de Usuario Premium
- Diseño responsive y accesible
- Navegación intuitiva y moderna
- Efectos visuales y microinteracciones
- Optimización móvil completa

## 🎯 Objetivos y Valor del Proyecto

1. **🌍 Digitalización Turística**: Modernizar la industria turística de Chanchamayo
2. **🤝 Conectividad**: Facilitar encuentro entre turistas y operadores locales
3. **💡 Innovación**: Aplicar tecnologías web modernas al turismo regional  
4. **🌱 Sostenibilidad**: Promover turismo responsable y consciente

## 📈 Métricas del Proyecto

- **📄 Líneas de Código**: ~5,000+ líneas
- **🗂️ Archivos**: 195 archivos organizados
- **📊 Tablas BD**: 8 entidades principales
- **🎨 Componentes UI**: 25+ componentes reutilizables
- **📱 Breakpoints**: 5 puntos de responsive design

## 👨‍💻 Desarrollador

**Rafael Fernández Durán**
- 📧 Email: [contacto@ejemplo.com](mailto:contacto@ejemplo.com)
- 🐙 GitHub: [@RafaelFernandezDuran](https://github.com/RafaelFernandezDuran)
- 💼 LinkedIn: [Perfil Profesional](https://linkedin.com/in/rafael-fernandez-duran)

## 📄 Licencia

Este proyecto está licenciado bajo la **MIT License** - ver el archivo [LICENSE](LICENSE) for details.

## 🤝 Contribuciones

Las contribuciones son bienvenidas y apreciadas:

1. **🍴 Fork** el proyecto
2. **🌟 Crea** una rama para tu feature (`git checkout -b feature/NewFeature`)
3. **💾 Commit** tus cambios (`git commit -m 'Add NewFeature'`)
4. **📤 Push** a la rama (`git push origin feature/NewFeature`)
5. **🔄 Abre** un Pull Request

---

## 🌟 Agradecimientos

- **Laravel Team** por el excelente framework
- **Comunidad Open Source** por las herramientas utilizadas
- **Región Chanchamayo** por la inspiración turística

---

<div align="center">

**⭐ ¡Dale una estrella si te gusta el proyecto! ⭐**

[![GitHub stars](https://img.shields.io/github/stars/RafaelFernandezDuran/Plataforma-web-de-turismo_Fern-ndez_Dur-n?style=social)](https://github.com/RafaelFernandezDuran/Plataforma-web-de-turismo_Fern-ndez_Dur-n)

</div>
