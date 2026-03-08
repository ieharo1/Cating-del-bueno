<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventory QR')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .sidebar {
            background: #2c3e50;
            min-height: 100vh;
            padding: 20px;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 12px 15px;
            display: block;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #34495e;
        }
        .stat-card {
            border-radius: 10px;
            padding: 20px;
            color: white;
        }
        .low-stock {
            background: #e74c3c;
        }
        .total-stock {
            background: #27ae60;
        }
        .total-products {
            background: #3498db;
        }
    </style>
    @livewireStyles
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <h4 class="text-white mb-4">
                    <i class="fas fa-boxes"></i> Inventory QR
                </h4>
                <a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a>
                <a href="#"><i class="fas fa-cubes"></i> Productos</a>
                <a href="#"><i class="fas fa-tags"></i> Categorías</a>
                <a href="#"><i class="fas fa-map-marker-alt"></i> Ubicaciones</a>
                <a href="#"><i class="fas fa-qrcode"></i> Escanear QR</a>
                <a href="#"><i fa-history"></i> Movimientos</a>
            </div>
            <div class="col-md-10 p-4">
                @yield('content')
            </div>
        </div>
    </div>

    @if($showScanner)
    <div class="modal d-block" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Escanear Código QR</h5>
                    <button type="button" class="btn-close" wire:click="$set('showScanner', false)"></button>
                </div>
                <div class="modal-body">
                    <p>Ingrese el código del producto manualmente:</p>
                    <input type="text" class="form-control" wire:model="scannedCode" 
                           placeholder="Código SKU" wire:keydown.enter="processScan">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="$set('showScanner', false)">Cancelar</button>
                    <button class="btn btn-primary" wire:click="processScan">Buscar</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($showPicking && $pickingProduct)
    <div class="modal d-block" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Picking</h5>
                    <button type="button" class="btn-close" wire:click="$set('showPicking', false)"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Producto:</strong> {{ $pickingProduct->name }}</p>
                    <p><strong>SKU:</strong> {{ $pickingProduct->sku }}</p>
                    <p><strong>Stock actual:</strong> {{ $pickingProduct->stock }}</p>
                    <div class="mb-3">
                        <label class="form-label">Cantidad a picking:</label>
                        <input type="number" class="form-control" wire:model="pickingQuantity" min="1" 
                               max="{{ $pickingProduct->stock }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="$set('showPicking', false)">Cancelar</button>
                    <button class="btn btn-success" wire:click="confirmPicking">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    @livewireScripts
    <script>
        window.addEventListener('notify', event => {
            alert(event.message);
        });
    </script>
</body>
</html>
