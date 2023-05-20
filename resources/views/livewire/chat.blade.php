<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 p-3">
                @if ($users->isNotEmpty())
                <div class="mb-3">
                    <label for="userSelect" class="form-label">Seleccionar usuario</label>
                    <div class="select-wrapper">
                        <select wire:model="selectedUser" class="form-select" id="userSelect">
                            <option value="">Seleccione</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 5.646a.5.5 0 0 1 .708 0L8 11.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                </div>
                
                @endif
                <div id="chat-messages" style="max-height: 600px; overflow-y: auto;">
                    @foreach ($messages as $message)
                        <div class="message-wrapper">
                            @if ($message->sender_id == Auth::id())
                                <div class="message sender ml-auto">
                                    <span class="font-bold">{{ $message->sender->name }}:</span><br>
                                    <span>{{ $message->message }}</span>
                                </div>
                            @else
                                <div class="message receiver">
                                    <span class="font-bold">{{ $message->sender->name }}:</span><br>
                                    <span>{{ $message->message }}</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <form wire:submit.prevent="sendMessage">
                    <div class="input-group mb-3 mt-3">
                        <input type="text" wire:model="message" class="form-control" placeholder="Escribe tu mensaje">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script>
            // Inicializar Pusher
            const pusher = new Pusher('2a3b6bf1da8f62e76d87', {
                cluster: 'mt1',
                encrypted: true,
            });

            // Suscribirse al canal 'chat-{{ Auth::id() }}' y escuchar el evento 'chat-message-sent'
            const channel = pusher.subscribe('apprentice-takeit');
            channel.bind('App\\Events\\ChatMessageSent', function(data) {
                window.livewire.emit('ListenDataMensaje', data);
            });
        </script>
    @endpush
</div>
