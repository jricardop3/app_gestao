<x-app-layout>

    <div class="py-12">
        <div class="container">
            <h1 class="text-2xl font-bold mb-4">Adicionar Conta</h1>

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.accounts.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <select id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="" disabled selected>Selecione</option>
                        <option value="pagar" {{ old('title') === 'pagar' ? 'selected' : '' }}>Pagar</option>
                        <option value="receber" {{ old('title') === 'receber' ? 'selected' : '' }}>Receber</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                    <input type="number" id="amount" name="amount" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" step="0.01" value="{{ old('amount') }}" required>
                </div>
                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Data de Vencimento</label>
                    <input type="date" id="due_date" name="due_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('due_date') }}" required>
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="pending" {{ old('status') === 'pendente' ? 'selected' : '' }}>Pendente</option>
                        <option value="paid" {{ old('status') === 'pago' ? 'selected' : '' }}>Pago</option>
                    </select>
                </div>
                <x-primary-button class="mt-4">{{ __('Salvar') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
