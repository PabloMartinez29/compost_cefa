# Script para compilar assets de Vite en Compost CEFA
# Ejecutar: .\build-assets.ps1

Write-Host "🚀 Compilando assets de Vite para Compost CEFA..." -ForegroundColor Green

# Verificar si Node.js está instalado
try {
    $nodeVersion = node --version
    Write-Host "✅ Node.js encontrado: $nodeVersion" -ForegroundColor Green
} catch {
    Write-Host "❌ Error: Node.js no está instalado o no está en el PATH" -ForegroundColor Red
    exit 1
}

# Verificar si npm está instalado
try {
    $npmVersion = npm --version
    Write-Host "✅ npm encontrado: $npmVersion" -ForegroundColor Green
} catch {
    Write-Host "❌ Error: npm no está instalado o no está en el PATH" -ForegroundColor Red
    exit 1
}

# Verificar si package.json existe
if (-not (Test-Path "package.json")) {
    Write-Host "❌ Error: package.json no encontrado en el directorio actual" -ForegroundColor Red
    exit 1
}

# Instalar dependencias si node_modules no existe
if (-not (Test-Path "node_modules")) {
    Write-Host "📦 Instalando dependencias..." -ForegroundColor Yellow
    npm install
    if ($LASTEXITCODE -ne 0) {
        Write-Host "❌ Error al instalar dependencias" -ForegroundColor Red
        exit 1
    }
}

# Compilar assets
Write-Host "🔨 Compilando assets..." -ForegroundColor Yellow
npm run build

if ($LASTEXITCODE -eq 0) {
    Write-Host "✅ Assets compilados exitosamente!" -ForegroundColor Green
    
    # Verificar que se creó el manifest.json
    if (Test-Path "public/build/manifest.json") {
        Write-Host "✅ manifest.json creado correctamente" -ForegroundColor Green
    } else {
        Write-Host "⚠️  Advertencia: manifest.json no encontrado" -ForegroundColor Yellow
    }
    
    # Mostrar archivos generados
    if (Test-Path "public/build/assets") {
        $assets = Get-ChildItem "public/build/assets" | Measure-Object
        Write-Host "📁 Se generaron $($assets.Count) archivos de assets" -ForegroundColor Green
    }
    
    Write-Host "🎉 ¡Proceso completado! Ya puedes ejecutar tu aplicación Laravel." -ForegroundColor Green
} else {
    Write-Host "❌ Error al compilar assets" -ForegroundColor Red
    exit 1
}
