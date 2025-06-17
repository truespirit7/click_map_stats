@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Карта кликов для сайта: {{ $site->name }}</h1>
    <div class="card">
        <div class="card-body">
            <div id="heatmapContainer" style="position: relative; height: 80vh; border: 1px solid #ddd; overflow: auto;">
                <div id="heatmapWrapper" style="position: relative;">
                    <div id="heatmap" style="position: absolute;"></div>
                </div>
            </div>
            <div class="mt-3">
                <button id="zoomIn" class="btn btn-sm btn-primary">+ Увеличить</button>
                <button id="zoomOut" class="btn btn-sm btn-primary">- Уменьшить</button>
                <span id="zoomLevel" class="ml-2">Масштаб: 100%</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .click-point {
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: rgba(255, 0, 0, 0.5);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/heatmap.js@2.0.5/build/heatmap.min.js"></script>
<script>
$(document).ready(function() {
    const siteId = {{ $site->id }};
    let heatmapInstance;
    let currentZoom = 1;
    let screenSize = { width: 1920, height: 1080 };
    
    // Инициализация тепловой карты
    function initHeatmap() {
        const container = document.getElementById('heatmap');
        container.style.width = screenSize.width + 'px';
        container.style.height = screenSize.height + 'px';
        
        heatmapInstance = h337.create({
            container,
            radius: 30,
            maxOpacity: 0.8,
            minOpacity: 0.1,
            blur: 0.8,
            gradient: {
                '.3': 'blue',
                '.5': 'green',
                '.7': 'yellow',
                '.95': 'red'
            }
        });
        
        updateZoom();
    }
    
    // Загрузка данных кликов
    function loadClickData() {
        $.get(`/api/sites/${siteId}/clickmap`, function(response) {
            if (response.screen_size) {
                screenSize = response.screen_size;
            }
            
            if (!heatmapInstance) {
                initHeatmap();
            }
            
            if (response.clicks && response.clicks.length > 0) {
                const points = response.clicks.map(click => ({
                    x: Math.round(click.x * currentZoom),
                    y: Math.round(click.y * currentZoom),
                    value: 1
                }));
                
                heatmapInstance.setData({
                    max: 10,
                    data: points
                });
            }
        });
    }
    
    // Обновление масштаба
    function updateZoom() {
        const wrapper = $('#heatmapWrapper');
        wrapper.css({
            'width': screenSize.width * currentZoom,
            'height': screenSize.height * currentZoom
        });
        
        $('#heatmap').css({
            'width': screenSize.width * currentZoom,
            'height': screenSize.height * currentZoom
        });
        
        $('#zoomLevel').text(`Масштаб: ${Math.round(currentZoom * 100)}%`);
        
        // Перезагружаем данные с новым масштабом
        loadClickData();
    }
    
    // Обработчики кнопок масштабирования
    $('#zoomIn').click(function() {
        currentZoom *= 1.2;
        updateZoom();
    });
    
    $('#zoomOut').click(function() {
        currentZoom /= 1.2;
        if (currentZoom < 0.1) currentZoom = 0.1;
        updateZoom();
    });
    
    // Первоначальная загрузка
    initHeatmap();
});
</script>
@endpush