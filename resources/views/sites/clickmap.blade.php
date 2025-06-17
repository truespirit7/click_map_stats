@extends('layouts.base')

@section('content')
<div class="container">
    <h1>Карта кликов: {{ $site->url }}</h1>
    
    <div style="position: relative; height: 80vh; border: 1px solid #ddd;">
        <!-- Iframe с целевым сайтом -->
        {{-- <iframe 
            id="siteFrame"
            src="{{ $site->url }}"
            style="width: 100%; height: 100%; border: none;"
            sandbox="allow-same-origin allow-scripts"
        ></iframe> --}}
        
        <!-- Наложение для кликов -->
        <div id="clickOverlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;"></div>
    </div>
    
    <div class="mt-3">
        <button id="refreshBtn" class="btn btn-sm btn-primary">Обновить клики</button>
        <span id="clickCount" class="ml-2">0 кликов</span>
    </div>
</div>
@endsection

<style>
    .click-dot {
        position: absolute;
        width: 12px;
        height: 12px;
        background-color: rgba(255, 0, 0, 0.7);
        border-radius: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  console.log('Test123123');
    const siteId = {{ $site->id }};
    const overlay = document.getElementById('clickOverlay');
    const frame = document.getElementById('siteFrame');
    const refreshBtn = document.getElementById('refreshBtn');
    const clickCount = document.getElementById('clickCount');
    
    // Загрузка и отображение кликов
    function loadClicks() {
      debugger;
        fetch(`/api/sites/${siteId}/clickmap`)
            .then(response => response.json())
            .then(clicks => { console.log(response.json()); })
            // .then(clicks => {
            //     renderClicks(clicks);
            //     clickCount.textContent = `${clicks.length} кликов`;
            // });
            debugger;
    }
    
    // Отрисовка кликов
    function renderClicks(clicks) {
        console.log(clicks);
        debugger;
        // Очищаем предыдущие клики
        overlay.innerHTML = '';
        
        if (!clicks || clicks.length === 0) return;
        
        // Получаем текущий размер iframe
        const frameWidth = frame.offsetWidth;
        const frameHeight = frame.offsetHeight;
        
        // Для каждого клика создаем точку
        clicks.forEach(click => {
            const dot = document.createElement('div');
            dot.className = 'click-dot';
            
            // Позиционируем точку (простое масштабирование)
            dot.style.left = `${(click.x / 100) * frameWidth}px`;
            dot.style.top = `${(click.y / 100) * frameHeight}px`;
            
            // Добавляем tooltip с датой
            dot.title = new Date(click.created_at).toLocaleString();
            
            overlay.appendChild(dot);
        });
    }
    
    // Обработчик кнопки обновления
    refreshBtn.addEventListener('click', loadClicks);
    
    // Первоначальная загрузка
    debugger;
    loadClicks();
    debugger;
    // Автообновление каждые 30 секунд
    setInterval(loadClicks, 30000);
});
</script>
