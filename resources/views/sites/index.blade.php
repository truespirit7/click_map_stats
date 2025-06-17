
@extends('layouts.base')

@section('title', 'Управление сайтами')

@section('content')

<div class="container mx-auto px-4 py-8" x-data="sitesData">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Заголовок -->
        <div class="bg-blue-600 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Добавление сайтов</h1>
        </div>
        
        <!-- Форма добавления -->
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL сайта (с указанием протокола: http или https)</label>
                    <input 
                        id="url"
                        x-model="url"
                        type="text" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="https://example.com"
                    >
                </div>
            </div>
            
            <button 
                @click="addSite()"
                class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Добавить сайт
            </button>
        </div>
        
        <!-- Список сайтов -->
        <div class="border-t border-gray-200 px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Мои сайты</h2>
            
            <template x-if="sites.length === 0">
                <p class="text-gray-500 italic">Нет добавленных сайтов</p>
            </template>
            
            <ul class="divide-y divide-gray-200" x-show="sites.length > 0">
                <template x-for="site in sites" :key="site.id">
                    <li class="py-3 flex items-center justify-between">
                        <span x-text="site.domain || site.url" class="font-medium text-gray-800"></span>

                        <a 
                            :href="`/sites/${site.id}/activity`" 
                            class="text-blue-600 hover:text-blue-800 transition-colors"
                            title="График активности"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </a>
                        <a 
                            :href="`/sites/${site.id}/clickmap`" 
                            class="text-green-600 hover:text-green-800 transition-colors"
                            title="Карта кликов"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                        </svg>    
                            </a>
                        <button 
                            @click="removeSite(site.id)"
                            class="text-red-500 hover:text-red-700 transition-colors"
                            title="Удалить"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</div>
<script src="{{ asset('js/sites.js') }}"></script>

@endsection