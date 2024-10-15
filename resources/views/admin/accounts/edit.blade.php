<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Editar Conta {{ $account->user->name }}</h3>

                    <!-- Notificações -->
                    <div class="p-6 text-gray-900">
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>

                    <!-- Formulário de Edição -->
                    <form method="POST" action="{{ route('admin.accounts.update', $account->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Usuário -->
                        <div class="mb-4">
                            <label for="user" class="block text-sm font-medium text-gray-700">Usuário</label>
                            <input type="text" name="user" id="user" value="{{ $account->user->name }}" disabled
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Título -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $account->title) }}" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Descrição -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea name="description" id="description" rows="3" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description', $account->description) }}</textarea>
                        </div>

                        <!-- Valor -->
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                            <input type="text" name="amount" id="amount" value="{{ old('amount', number_format($account->amount, 2, ',', '.')) }}" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Data de Vencimento -->
                        <div class="mb-4">
                            <label for="due_date" class="block text-sm font-medium text-gray-700">Data de Vencimento</label>
                            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $account->due_date->format('Y-m-d')) }}" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="pending" {{ old('status', $account->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="paid" {{ old('status', $account->status) == 'pago' ? 'selected' : '' }}>Pago</option>
                            </select>
                        </div>

                        <!-- Botões -->
                        <div class="flex justify-end">
                            <a href="{{ route('admin.accounts.index') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2">
                                Cancelar
                            </a>
                            <x-primary-button class="ml-4">
                                Salvar
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
