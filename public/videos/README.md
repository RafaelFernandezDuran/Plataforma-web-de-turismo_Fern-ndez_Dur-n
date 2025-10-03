# Videos para Hero Background

## Instrucciones para agregar video de fondo

### 1. **Descargar un video apropiado**

Recomendamos videos de:
- **Pexels.com** (gratuitos): https://www.pexels.com/videos/
- **Pixabay.com** (gratuitos): https://pixabay.com/videos/
- **Unsplash.com** (gratuitos): https://unsplash.com/

**Búsquedas recomendadas:**
- "jungle waterfall"
- "rainforest"
- "tropical forest"
- "nature landscape"
- "mountain stream"

### 2. **Especificaciones recomendadas**
- **Resolución**: Mínimo 1920x1080 (Full HD)
- **Formato**: MP4 (H.264)
- **Duración**: 10-30 segundos (se reproduce en loop)
- **Tamaño**: Menos de 10MB para carga rápida
- **Aspect Ratio**: 16:9

### 3. **Nombrar el archivo**
Guarda el video como: `hero-background.mp4`

### 4. **Actualizar el código**
Una vez que tengas el video, modifica el archivo `welcome.blade.php`:

```html
<source src="{{ asset('videos/hero-background.mp4') }}" type="video/mp4">
```

### 5. **Videos recomendados específicos**

**Chanchamayo/Selva Central:**
1. https://www.pexels.com/video/aerial-footage-of-a-forest-with-a-river-3571264/
2. https://www.pexels.com/video/drone-footage-of-forest-and-river-3249936/
3. https://www.pexels.com/video/time-lapse-video-of-waterfalls-3048951/

**Alternativas generales:**
1. https://pixabay.com/videos/waterfall-nature-water-landscape-28948/
2. https://pixabay.com/videos/forest-trees-nature-green-woods-31041/

### 6. **Optimización**
- Comprime el video usando herramientas como HandBrake
- Considera usar formato WebM para mejor compresión
- Agrega múltiples formatos para compatibilidad