
@extends('layouts.base') <!-- Указываем какой layout использовать -->

@section('title', 'Заголовок страницы') <!-- Устанавливаем title -->

@section('content') <!-- Заполняем секцию content -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="{{ asset('js/sites.js') }}"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Tracked Sites</h1>
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <div x-data = "{ name: '', url: '' }" x-init class="flex space-x-4">
                @csrf
                <input type="text" name="name" placeholder="Site Name" class="border rounded-lg p-2 flex-1" x-model="name">
                <input type="text" name="url" placeholder="URL" class="border rounded-lg p-2 flex-1" x-model="url">
                <button @click="addSite()" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add Site</button>
            </div>
        </div>
        <ul class="grid grid-cols-1 gap-4">

            <div x-data="{
            sites: [],
            getSites: async () => {
                return await (await fetch('/api/sites')).json();
            }
            
            }" x-init="sites = await getSites()" class="space-y-4">
                <template x-for="site in sites" :key="site.id">
                    <li class="bg-white shadow-md rounded-lg p-4">
                        <a :href="`/api/show/${site.id}`"
                            class="text-blue-600 hover:underline text-lg"
                            x-text="site.name"></a>
                        <p class="text-gray-600" x-text="site.url"></p>
                    </li>
                </template>
            </div>
        </ul>
    </div>

@endsection


@extends('layouts.base') <!-- Указываем какой layout использовать -->

@section('title', 'Заголовок страницы') <!-- Устанавливаем title -->

@section('content') <!-- Заполняем секцию content -->
<div x-data="{ message: 'Привет, Alpine!' }">
    <h1 x-text="message"></h1>
    <p>Основное содержимое страницы...</p>
</div>


<div x-data="{
    sites: [],
    url: '',
    name: '',
    async loadSites() {
        try {
            const response = await fetch('/api/sites');
            this.sites = await response.json();
        } catch (error) {
            console.error('Ошибка загрузки:', error);
        }
    },
    async addSite() {
    console.log(123123123123)
        try {
            const response = await fetch('/api/sites', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    name: this.name,
                    url: this.url 
                })
            });
            
            if (response.ok) {
                await this.loadSites();
                this.name = '';
                this.url = '';
            }
        } catch (error) {
            console.error('Ошибка добавления:', error);
        }
    }
}" x-init="loadSites()">
    <input x-model="url" placeholder="Введите домен">
    <input x-model="name" placeholder="Введите название">
    <button @click="addSite()">Добавить</button>

    <ul>
        <template x-for="site in sites" :key="site.id">
            <li x-text="site.domain || site.url"></li>
        </template>
    </ul>
</div>


@endsection