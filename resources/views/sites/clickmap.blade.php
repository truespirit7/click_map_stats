@extends('layouts.base')
@section('content')
<head>
    <title>Карта кликов</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            position: relative;
            min-height: 100vh;
        }
        #site-container {
            position: relative;
            width: 100%;
            height: 80vh;
            border: 1px solid #ccc;
            overflow: hidden;
        }
        #site-frame {
            width: 100%;
            height: 100%;
            border: none;
        }
        .click-spot {
            position: absolute;
            width: 15px;
            height: 15px;
            background-color: rgba(255, 0, 0, 0.5);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 1000;
        }
        #controls {
            margin-bottom: 20px;
        }
        #heatmap {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        #loadBtn, #clearBtn {
            padding: 10px 15px;
            margin-right: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="controls">
        <h1>Карта кликов {{ $site->url}}</h1>
        <button style= "color" id="loadBtn">Показать клики</button>
        <button id="clearBtn">Скрыть клики</button>
    </div>
    
    <div id="site-container">
        <iframe id="site-frame" src="{{ $site->url }}"></iframe>
        <div id="heatmap"></div>
    </div>


    <script>
        document.getElementById('loadBtn').addEventListener('click', loadClicks);
        document.getElementById('clearBtn').addEventListener('click', clearClicks);

        async function loadClicks() {
            try {
                const response = await fetch('/api/sites/{{ $site->id }}/clickmap'); 
                const clicks = await response.json();
                
                clicks.forEach(click => {
                    const spot = document.createElement('div');
                    spot.className = 'click-spot';
                    spot.style.left = `${click.x}px`;
                    spot.style.top = `${click.y}px`;
                    spot.title = `Дата: ${click.timestamp}`;
                    document.body.appendChild(spot);
                });


                
                console.log(`Загружено ${clicks.length} кликов`);
            } catch (error) {
                console.error('Ошибка загрузки:', error);
            }
        }

        function clearClicks() {
            document.querySelectorAll('.click-spot').forEach(spot => spot.remove());
        }
    </script>
@endsection
