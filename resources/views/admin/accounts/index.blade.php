<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Resumo das Contas -->
                        <div class="p-6 text-gray-900 bg-gray-100 rounded-md shadow mb-4">
                            <h3 class="font-semibold text-lg">Resumo das Contas</h3>
                            <ul class="list-disc pl-5">
                                <li>Total a Pagar: <strong>R$ {{ number_format($totalToPay, 2, ',', '.') }}</strong></li>
                                <li>Total a Receber: <strong>R$ {{ number_format($totalToReceive, 2, ',', '.') }}</strong></li>
                                <li>Contas Pendentes: <strong>{{ $pendingCount }}</strong></li>
                            </ul>
                        </div>
                
                        <!-- Formulário de Relatório -->
                        <div class="p-6 text-gray-900 bg-gray-100 rounded-md shadow mb-4">
                            <form action="{{ route('admin.reports.user') }}" method="POST" class="flex items-center">
                                @csrf
                                <label for="user_id" class="mr-2">Usuários:</label>
                                <select name="user_id" id="user_id" class="border border-gray-300 rounded-md p-2">
                                    <option value="">Selecione um usuário</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="ml-2">
                                    <x-primary-button>
                                        Relatório
                                    </x-primary-button>
                                </button>
                            </form>
                            
                        </div>
                    </div>
                
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
                </div>
                
                
                

                <!-- Resumo das Contas -->

                <!-- Lista de Contas de Todos os Usuários -->
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Contas de Todos os Usuários</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Usuário</th>
                                <th class="px-4 py-2">Título</th>
                                <th class="px-4 py-2">Descrição</th>
                                <th class="px-4 py-2">Valor</th>
                                <th class="px-4 py-2">Data de Vencimento</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allAccounts as $account)
                                <tr class="{{ $account->due_date < now() && $account->status != 'pago' ? 'bg-red-100' : '' }}">
                                    <td class="px-4 py-2">{{ $account->user->name }}</td> <!-- Exibindo nome do usuário -->
                                    <td class="px-4 py-2">{{ $account->title }}</td>
                                    <td class="px-4 py-2">{{ $account->description }}</td>
                                    <td class="px-4 py-2">R$ {{ number_format($account->amount, 2, ',', '.') }}</td>
                                    <td class="px-4 py-2">{{ $account->due_date->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2">
                                        <span class="{{ $account->status == 'pago' ? 'text-green-600' : 'text-yellow-600' }}">
                                            {{ ucfirst($account->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('admin.accounts.edit', $account->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                                        <form action="{{ route('admin.accounts.destroy', $account->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Paginação -->
                    <div class="mt-6 flex justify-center">
                        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center space-x-2">
                            @if ($allAccounts->onFirstPage())
                                <span class="px-3 py-1 bg-gray-200 text-gray-500 cursor-not-allowed rounded-md">Anterior</span>
                            @else
                                <a href="{{ $allAccounts->previousPageUrl() }}" class="px-3 py-1 bg-gray-200 text-gray-700 hover:bg-gray-300 rounded-md">Anterior</a>
                            @endif
                    
                            @foreach ($allAccounts->links()->elements[0] as $page => $url)
                                @if ($page == $allAccounts->currentPage())
                                    <span class="px-3 py-1 bg-gray-500 text-white font-semibold rounded-md">{{ $page }}</span> <!-- Cor verde -->
                                @else
                                    <a href="{{ $url }}" class="px-3 py-1 bg-gray-200 text-gray-700 hover:bg-gray-300 rounded-md">{{ $page }}</a>
                                @endif
                            @endforeach
                    
                            @if ($allAccounts->hasMorePages())
                                <a href="{{ $allAccounts->nextPageUrl() }}" class="px-3 py-1 bg-gray-200 text-gray-700 hover:bg-gray-300 rounded-md">Próxima</a>
                            @else
                                <span class="px-3 py-1 bg-gray-200 text-gray-500 cursor-not-allowed rounded-md">Próxima</span>
                            @endif
                        </nav>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
