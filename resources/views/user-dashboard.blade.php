<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Bem-vindo ao Painel do Usuário!</h3>
                    <p>{{ __("Você está logado como usuário!") }}</p>
                    <!-- Adicione mais conteúdo específico para o painel do usuário aqui -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
