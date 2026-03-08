@extends('layouts.app')

@section('title', 'Inventory QR - Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2><i class="fas fa-chart-line"></i> Dashboard de Inventario</h2>
            <div>
                <button class="btn btn-primary" wire:click="$set('showScanner', true)">
                    <i class="fas fa-qrcode"></i> Escanear QR
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card total-products">
            <h3><i class="fas fa-cubes"></i> {{ $totalProducts }}</h3>
            <p>Total Productos</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card total-stock">
            <h3><i class="fas fa-boxes"></i> {{ $totalStock }}</h3>
            <p>Stock Total</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card low-stock">
            <h3><i class="fas fa-exclamation-triangle"></i> {{ $lowStock }}</h3>
            <p>Productos Bajo Stock</p>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Buscar productos..." wire:model="search">
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-list"></i> Productos</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Ubicación</th>
                            <th>Stock</th>
                            <th>Stock Mín.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filteredProducts as $product)
                        <tr class="{{ $product['stock'] <= $product['min_stock'] ? 'table-warning' : '' }}">
                            <td><code>{{ $product['sku'] }}</code></td>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ $product['category']['name'] ?? 'N/A' }}</td>
                            <td>{{ $product['location']['name'] ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-{{ $product['stock'] <= $product['min_stock'] ? 'danger' : 'success' }}">
                                    {{ $product['stock'] }}
                                </span>
                            </td>
                            <td>{{ $product['min_stock'] }}</td>
                            <td>
                                <button class="btn btn-sm btn-success" wire:click="addStock({{ $product['id'] }})">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-history"></i> Movimientos Recientes</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
                            <th>Notas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentMovements as $movement)
                        <tr>
                            <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $movement->product->name }}</td>
                            <td>
                                <span class="badge bg-{{ $movement->type == 'in' ? 'success' : ($movement->type == 'out' ? 'danger' : 'warning') }}">
                                    {{ $movement->type }}
                                </span>
                            </td>
                            <td>{{ $movement->quantity }}</td>
                            <td>{{ $movement->notes }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
