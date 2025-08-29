#!/bin/bash

# Script para compilar assets de Vite en Compost CEFA
# Ejecutar: ./build-assets.sh

echo "🚀 Compilando assets de Vite para Compost CEFA..."

# Verificar si Node.js está instalado
if ! command -v node &> /dev/null; then
    echo "❌ Error: Node.js no está instalado o no está en el PATH"
    exit 1
else
    NODE_VERSION=$(node --version)
    echo "✅ Node.js encontrado: $NODE_VERSION"
fi

# Verificar si npm está instalado
if ! command -v npm &> /dev/null; then
    echo "❌ Error: npm no está instalado o no está en el PATH"
    exit 1
else
    NPM_VERSION=$(npm --version)
    echo "✅ npm encontrado: $NPM_VERSION"
fi

# Verificar si package.json existe
if [ ! -f "package.json" ]; then
    echo "❌ Error: package.json no encontrado en el directorio actual"
    exit 1
fi

# Instalar dependencias si node_modules no existe
if [ ! -d "node_modules" ]; then
    echo "📦 Instalando dependencias..."
    npm install
    if [ $? -ne 0 ]; then
        echo "❌ Error al instalar dependencias"
        exit 1
    fi
fi

# Compilar assets
echo "🔨 Compilando assets..."
npm run build

if [ $? -eq 0 ]; then
    echo "✅ Assets compilados exitosamente!"
    
    # Verificar que se creó el manifest.json
    if [ -f "public/build/manifest.json" ]; then
        echo "✅ manifest.json creado correctamente"
    else
        echo "⚠️  Advertencia: manifest.json no encontrado"
    fi
    
    # Mostrar archivos generados
    if [ -d "public/build/assets" ]; then
        ASSET_COUNT=$(ls public/build/assets/ | wc -l)
        echo "📁 Se generaron $ASSET_COUNT archivos de assets"
    fi
    
    echo "🎉 ¡Proceso completado! Ya puedes ejecutar tu aplicación Laravel."
else
    echo "❌ Error al compilar assets"
    exit 1
fi
