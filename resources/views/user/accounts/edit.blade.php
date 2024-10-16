<x-app-layout>
    <div class="py-12">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Editar Conta</h1>

            <!-- Exibir mensagens de sucesso ou erro -->
            @if(session('success'))
                <div class="mb-4 p-2 text-green-600 bg-green-100 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-2 text-red-600 bg-red-100 border border-red-300 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('user.accounts.update', $account) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <select id="title" name="title" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="pagar" {{ old('title', $account->title) === 'pagar' ? 'selected' : '' }}>Pagar</option>
                        <option value="receber" {{ old('title', $account->title) === 'receber' ? 'selected' : '' }}>Receber</option>
                    </select>
                    @error('title')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" name="description" rows="4">{{ old('description', $account->description) }}</textarea>
                    @error('description')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                    <input type="number" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" name="amount" value="{{ old('amount', $account->amount) }}" step="0.01" required>
                    @error('amount')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Data de Vencimento</label>
                    <input type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" name="due_date" value="{{ old('due_date', $account->due_date) }}" required>
                    @error('due_date')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" name="status" required>
                        <option value="pending" {{ old('status', $account->status) === 'pending' ? 'selected' : '' }}>Pendente</option>
                        <option value="paid" {{ old('status', $account->status) === 'paid' ? 'selected' : '' }}>Pago</option>
                    </select>
                    @error('status')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-6 flex justify-between">
                    <x-primary-button type="submit">{{ __('Atualizar') }}</x-primary-button>                
                </div>
            </form>

            <!-- Formulário para Exclusão -->
            <form action="{{ route('user.accounts.destroy', $account) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <x-danger-button>{{ __('Excluir') }}</x-danger-button>
            </form>
        </div>
    </div>
</x-app-layout>
