<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Editar Conta</h1>

            <form action="{{ route('user.accounts.update', $account) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" name="title" value="{{ $account->title }}" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" name="description" rows="4" required>{{ $account->description }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Valor</label>
                    <input type="number" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" name="amount" value="{{ $account->amount }}" step="0.01" required>
                </div>

                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Data de Vencimento</label>
                    <input type="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" name="due_date" value="{{ $account->due_date }}" required>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" name="status" required>
                        <option value="pending" {{ $account->status === 'pending' ? 'selected' : '' }}>Pendente</option>
                        <option value="paid" {{ $account->status === 'paid' ? 'selected' : '' }}>Pago</option>
                    </select>
                </div>

                <div class="mt-6 flex justify-between">
                    <x-primary-button type="submit">{{ __('Atualizar') }}</x-primary-button>                

                    <form action="{{ route('user.accounts.destroy', $account) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>{{ __('Excluir') }}</x-danger-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
